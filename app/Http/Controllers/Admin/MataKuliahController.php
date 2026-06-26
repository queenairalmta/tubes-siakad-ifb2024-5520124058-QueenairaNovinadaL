<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = MataKuliah::query();

        if ($request->filled('cari')) {
            $query->where('nama_matakuliah', 'like', '%' . $request->cari . '%')
                  ->orWhere('kode_matakuliah', 'like', '%' . $request->cari . '%');
        }

        $matakuliah = $query->orderBy('nama_matakuliah')->paginate(10)->withQueryString();

        return view('admin.matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('admin.matakuliah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => 'required|max:8|unique:matakuliah,kode_matakuliah',
            'nama_matakuliah' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        MataKuliah::create($validated);

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $matakuliah)
    {
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, MataKuliah $matakuliah)
    {
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'max:8', Rule::unique('matakuliah', 'kode_matakuliah')->ignore($matakuliah->kode_matakuliah, 'kode_matakuliah')],
            'nama_matakuliah' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $matakuliah->update($validated);

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil diupdate.');
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}