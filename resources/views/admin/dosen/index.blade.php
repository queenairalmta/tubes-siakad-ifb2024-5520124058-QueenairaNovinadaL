<x-admin-layout title="Data Dosen">

    <div class="page-title">Data Dosen</div>
    <div class="page-sub">Kelola data seluruh dosen</div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-card">
        <div class="toolbar">
            <form method="GET" class="search-box">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama/NIDN..." class="search-input">
                <button class="btn-search">Cari</button>
            </form>
            <a href="{{ route('admin.dosen.create') }}" class="btn-add">+ Tambah Dosen</a>
        </div>

        <table class="crud-table">
            <thead>
                <tr>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dosen as $d)
                    <tr>
                        <td>{{ $d->nidn }}</td>
                        <td>{{ $d->nama }}</td>
                        <td style="display:flex;gap:12px;align-items:center;">
                            <a href="{{ route('admin.dosen.edit', $d->nidn) }}" class="action-link">Edit</a>
                            <form action="{{ route('admin.dosen.destroy', $d->nidn) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="action-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" style="text-align:center;color:#666;">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-wrap">{{ $dosen->links() }}</div>
    </div>

</x-admin-layout>