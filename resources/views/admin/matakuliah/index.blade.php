<x-admin-layout title="Data Mata Kuliah">

    <div class="page-title">Data Mata Kuliah</div>
    <div class="page-sub">Kelola seluruh mata kuliah</div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-card">
        <div class="toolbar">
            <form method="GET" class="search-box">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama/kode..." class="search-input">
                <button class="btn-search">Cari</button>
            </form>
            <a href="{{ route('admin.matakuliah.create') }}" class="btn-add">+ Tambah Mata Kuliah</a>
        </div>

        <table class="crud-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($matakuliah as $mk)
                    <tr>
                        <td>{{ $mk->kode_matakuliah }}</td>
                        <td>{{ $mk->nama_matakuliah }}</td>
                        <td>{{ $mk->sks }}</td>
                        <td style="display:flex;gap:12px;align-items:center;">
                            <a href="{{ route('admin.matakuliah.edit', $mk->kode_matakuliah) }}" class="action-link">Edit</a>
                            <form action="{{ route('admin.matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="action-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align:center;color:#666;">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-wrap">{{ $matakuliah->links() }}</div>
    </div>

</x-admin-layout>