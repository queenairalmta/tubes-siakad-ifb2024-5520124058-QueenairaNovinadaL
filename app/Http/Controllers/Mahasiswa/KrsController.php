<?php

namespace App\Http\Controllers\Mahasiswa;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        $npm = auth()->user()->npm;

        $krs = Krs::with('mataKuliah')
            ->where('npm', $npm)
            ->get();

        $totalSks = $krs->sum(fn ($item) => $item->mataKuliah->sks ?? 0);

        return view('mahasiswa.krs.index', compact('krs', 'totalSks'));
    }

    public function exportPdf()
    {
        $npm = auth()->user()->npm;

        $mahasiswa = \App\Models\Mahasiswa::find($npm);
        $krs = Krs::with('mataKuliah')->where('npm', $npm)->get();
        $totalSks = $krs->sum(fn ($item) => $item->mataKuliah->sks ?? 0);

        $pdf = Pdf::loadView('mahasiswa.krs.pdf', compact('mahasiswa', 'krs', 'totalSks'));

        return $pdf->download('KRS_' . $npm . '.pdf');
    }

    public function create()
    {
        $npm = auth()->user()->npm;

        // mata kuliah yang BELUM diambil mahasiswa ini
        $sudahDiambil = Krs::where('npm', $npm)->pluck('kode_matakuliah');

        $matakuliah = MataKuliah::whereNotIn('kode_matakuliah', $sudahDiambil)
            ->orderBy('nama_matakuliah')
            ->get();

        return view('mahasiswa.krs.create', compact('matakuliah'));
    }

    public function store(Request $request)
    {
        $npm = auth()->user()->npm;

        $validated = $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
        ]);

        // cegah ambil mata kuliah yang sama 2x
        $sudahAda = Krs::where('npm', $npm)
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->exists();

        if ($sudahAda) {
            return back()->withErrors(['kode_matakuliah' => 'Mata kuliah ini sudah ada di KRS Anda.']);
        }

        // batas maksimal SKS, misalnya 24 SKS
        $totalSksSekarang = Krs::where('npm', $npm)
            ->with('mataKuliah')
            ->get()
            ->sum(fn ($item) => $item->mataKuliah->sks ?? 0);

        $mataKuliahBaru = MataKuliah::find($validated['kode_matakuliah']);

        if (($totalSksSekarang + $mataKuliahBaru->sks) > 24) {
            return back()->withErrors(['kode_matakuliah' => 'Total SKS melebihi batas maksimal (24 SKS).']);
        }

        Krs::create([
            'npm' => $npm,
            'kode_matakuliah' => $validated['kode_matakuliah'],
        ]);

        return redirect()->route('mahasiswa.krs.index')->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    public function destroy(Krs $krs)
    {
        $krs->delete();

        return redirect()->route('mahasiswa.krs.index')->with('success', 'Mata kuliah berhasil di-drop dari KRS.');
    }
}