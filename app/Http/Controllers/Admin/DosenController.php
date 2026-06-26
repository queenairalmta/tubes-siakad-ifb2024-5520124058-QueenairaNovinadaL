<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dosen::query();

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%')
                  ->orWhere('nidn', 'like', '%' . $request->cari . '%');
        }

        $dosen = $query->orderBy('nama')->paginate(10)->withQueryString();

        return view('admin.dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'required|digits:10|unique:dosen,nidn',
            'nama' => 'required|string|max:50',
        ]);

        Dosen::create($validated);

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nidn' => ['required', 'digits:10', Rule::unique('dosen', 'nidn')->ignore($dosen->nidn, 'nidn')],
            'nama' => 'required|string|max:50',
        ]);

        $dosen->update($validated);

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diupdate.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil dihapus.');
    }
}