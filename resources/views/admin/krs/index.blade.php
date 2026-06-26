<x-admin-layout title="KRS Mahasiswa">

    <div class="page-title">KRS Mahasiswa</div>
    <div class="page-sub">Daftar seluruh pengambilan mata kuliah mahasiswa</div>

    <div class="page-card">
        <div style="display:flex;justify-content:flex-end;margin-bottom:16px;">
            <a href="{{ route('admin.export.krs') }}" style="background:#1a2e1a;color:#4ade80;font-size:13px;padding:8px 16px;border-radius:8px;text-decoration:none;border:1px solid #2a4a2a;">
                ↓ Export Excel
            </a>
        </div>

        <table class="crud-table">
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Waktu Ambil</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($krs as $k)
                    <tr>
                        <td>{{ $k->npm }}</td>
                        <td>{{ $k->mahasiswa->nama ?? '-' }}</td>
                        <td><span style="background:#252000;color:#c9a84c;font-size:11px;padding:2px 8px;border-radius:99px;">{{ $k->mataKuliah->kode_matakuliah ?? '-' }}</span></td>
                        <td>{{ $k->mataKuliah->nama_matakuliah ?? '-' }}</td>
                        <td>{{ $k->mataKuliah->sks ?? '-' }} SKS</td>
                        <td style="color:#666;font-size:12px;">{{ $k->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;color:#666;padding:24px;">Belum ada data KRS.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-wrap">{{ $krs->links() }}</div>
    </div>

</x-admin-layout>