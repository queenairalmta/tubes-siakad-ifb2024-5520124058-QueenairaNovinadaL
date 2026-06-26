<x-mahasiswa-layout title="Jadwal Kuliah">

    <div class="page-title">Jadwal Perkuliahan</div>
    <div class="page-sub">Daftar seluruh jadwal kuliah yang tersedia</div>

    <div class="page-card">
        <table>
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Kelas</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>SKS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwal as $j)
                    <tr>
                        <td>{{ $j->mataKuliah->nama_matakuliah ?? '-' }}</td>
                        <td>{{ $j->dosen->nama ?? '-' }}</td>
                        <td><span class="badge-teal">{{ $j->kelas }}</span></td>
                        <td>{{ $j->hari }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($j->jam)->format('H:i') }}</td>
                        <td><span class="badge-gray">{{ $j->mataKuliah->sks ?? '-' }} SKS</span></td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;color:#4a7a7a;padding:24px;">Belum ada jadwal tersedia.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-mahasiswa-layout>