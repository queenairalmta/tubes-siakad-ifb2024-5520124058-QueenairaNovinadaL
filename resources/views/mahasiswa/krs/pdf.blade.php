<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Rencana Studi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 0; }
        p.sub { text-align: center; margin-top: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background-color: #eee; }
        .info { margin-top: 15px; }
        .total { margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>
    <h2>KARTU RENCANA STUDI (KRS)</h2>
    <p class="sub">Sistem Informasi Akademik Sederhana</p>

    <div class="info">
        <p><strong>NPM</strong>: {{ $mahasiswa->npm ?? '-' }}</p>
        <p><strong>Nama</strong>: {{ $mahasiswa->nama ?? '-' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($krs as $i => $k)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $k->mataKuliah->kode_matakuliah ?? '-' }}</td>
                    <td>{{ $k->mataKuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $k->mataKuliah->sks ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" style="text-align:center;">Belum mengambil mata kuliah.</td></tr>
            @endforelse
        </tbody>
    </table>

    <p class="total">Total SKS: {{ $totalSks }}</p>
</body>
</html>