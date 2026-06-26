<x-admin-layout title="Data Mahasiswa">

    <div class="page-title">Data Mahasiswa</div>
    <div class="page-sub">Kelola data seluruh mahasiswa</div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-card">
        <div class="toolbar">
            <form method="GET" class="search-box">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama/NPM..." class="search-input">
                <button class="btn-search">Cari</button>
            </form>
            <a href="{{ route('admin.mahasiswa.create') }}" class="btn-add">+ Tambah Mahasiswa</a>
        </div>

        <table class="crud-table">
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Dosen Wali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $m)
                    <tr>
                        <td>{{ $m->npm }}</td>
                        <td>{{ $m->nama }}</td>
                        <td>{{ $m->dosen->nama ?? '-' }}</td>
                        <td style="display:flex;gap:12px;align-items:center;">
                            <a href="{{ route('admin.mahasiswa.edit', $m->npm) }}" class="action-link">Edit</a>
                            <form action="{{ route('admin.mahasiswa.destroy', $m->npm) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
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
        <div class="pagination-wrap">{{ $mahasiswa->links() }}</div>
    </div>

</x-admin-layout>