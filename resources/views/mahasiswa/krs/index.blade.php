<x-mahasiswa-layout title="KRS Saya">

    <div class="page-title">Kartu Rencana Studi (KRS)</div>
    <div class="page-sub">Daftar mata kuliah yang sedang kamu ambil</div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @php $persen = $totalSks > 0 ? min(($totalSks / 24) * 100, 100) : 0; @endphp

    <div class="page-card">
        {{-- SKS Progress --}}
        <div class="sks-bar-wrap">
            <div class="sks-bar-info">
                <span>Total SKS diambil</span>
                <span>{{ $totalSks }} / 24 SKS</span>
            </div>
            <div class="sks-track">
                <div class="sks-fill" style="width: {{ $persen }}%"></div>
            </div>
        </div>

        <div class="toolbar">
            <span style="font-size:13px;color:#4a7a7a;">{{ $krs->count() }} mata kuliah diambil</span>
            <div style="display:flex;gap:10px;">
                <a href="{{ route('mahasiswa.krs.export.pdf') }}" style="background:#0a2e2e;color:#2dd4bf;font-size:13px;padding:8px 16px;border-radius:8px;text-decoration:none;border:1px solid #1a4a4a;">
                    ↓ Export PDF
                </a>
                <a href="{{ route('mahasiswa.krs.create') }}" class="btn-primary">+ Ambil Mata Kuliah</a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($krs as $i => $k)
                    <tr>
                        <td style="color:#4a7a7a;">{{ $i + 1 }}</td>
                        <td><span class="badge-teal">{{ $k->mataKuliah->kode_matakuliah ?? '-' }}</span></td>
                        <td>{{ $k->mataKuliah->nama_matakuliah ?? '-' }}</td>
                        <td><span class="badge-gray">{{ $k->mataKuliah->sks ?? '-' }} SKS</span></td>
                        <td>
                            <form action="{{ route('mahasiswa.krs.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin drop mata kuliah ini?')">
                                @csrf @method('DELETE')
                                <button class="btn-danger">Drop</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#4a7a7a;padding:24px;">Belum mengambil mata kuliah apapun.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-mahasiswa-layout>