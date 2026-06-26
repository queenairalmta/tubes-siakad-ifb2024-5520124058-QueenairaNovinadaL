<x-admin-layout title="Data Jadwal">

    <div class="page-title">Jadwal Perkuliahan</div>
    <div class="page-sub">Kelola jadwal kuliah seluruh mata kuliah</div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-card">
        <div class="toolbar">
            <form method="GET" class="search-box">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari mata kuliah/dosen..." class="search-input">
                <button class="btn-search">Cari</button>
            </form>
            <a href="{{ route('admin.jadwal.create') }}" class="btn-add">+ Tambah Jadwal</a>
        </div>

        <table class="crud-table">
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Kelas</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwal as $j)
                    <tr>
                        <td>{{ $j->mataKuliah->nama_matakuliah ?? '-' }}</td>
                        <td>{{ $j->dosen->nama ?? '-' }}</td>
                        <td>{{ $j->kelas }}</td>
                        <td>{{ $j->hari }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($j->jam)->format('H:i') }}</td>
                        <td style="display:flex;gap:12px;align-items:center;">
                            <a href="{{ route('admin.jadwal.edit', $j->id) }}" class="action-link">Edit</a>
                            <form action="{{ route('admin.jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="action-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;color:#666;">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-wrap">{{ $jadwal->links() }}</div>
    </div>

</x-admin-layout>