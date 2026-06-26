<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('dosen');

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%')
                  ->orWhere('npm', 'like', '%' . $request->cari . '%');
        }

        $mahasiswa = $query->orderBy('nama')->paginate(10)->withQueryString();

        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $dosen = Dosen::orderBy('nama')->get();
        return view('admin.mahasiswa.create', compact('dosen'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm' => 'required|digits:10|unique:mahasiswa,npm',
            'nama' => 'required|string|max:50',
            'nidn' => 'nullable|exists:dosen,nidn',
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosen = Dosen::orderBy('nama')->get();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'dosen'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'npm' => ['required', 'digits:10', Rule::unique('mahasiswa', 'npm')->ignore($mahasiswa->npm, 'npm')],
            'nama' => 'required|string|max:50',
            'nidn' => 'nullable|exists:dosen,nidn',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    public function krs()
    {
        $krs = \App\Models\Krs::with(['mahasiswa', 'mataKuliah'])
            ->orderBy('npm')
            ->paginate(15);

        return view('admin.krs.index', compact('krs'));
    }
}