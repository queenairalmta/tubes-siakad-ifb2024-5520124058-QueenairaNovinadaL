<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['dosen', 'mataKuliah']);

        if ($request->filled('cari')) {
            $query->whereHas('mataKuliah', function ($q) use ($request) {
                $q->where('nama_matakuliah', 'like', '%' . $request->cari . '%');
            })->orWhereHas('dosen', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->cari . '%');
            });
        }

        $jadwal = $query->orderBy('hari')->paginate(10)->withQueryString();

        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $dosen = Dosen::orderBy('nama')->get();
        $matakuliah = MataKuliah::orderBy('nama_matakuliah')->get();
        return view('admin.jadwal.create', compact('dosen', 'matakuliah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn' => 'required|exists:dosen,nidn',
            'kelas' => 'required|string|max:1',
            'hari' => 'required|string|max:10',
            'jam' => 'required|date_format:H:i',
        ]);

        Jadwal::create($validated);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Jadwal $jadwal)
    {
        $dosen = Dosen::orderBy('nama')->get();
        $matakuliah = MataKuliah::orderBy('nama_matakuliah')->get();
        return view('admin.jadwal.edit', compact('jadwal', 'dosen', 'matakuliah'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn' => 'required|exists:dosen,nidn',
            'kelas' => 'required|string|max:1',
            'hari' => 'required|string|max:10',
            'jam' => 'required|date_format:H:i',
        ]);

        $jadwal->update($validated);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diupdate.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}