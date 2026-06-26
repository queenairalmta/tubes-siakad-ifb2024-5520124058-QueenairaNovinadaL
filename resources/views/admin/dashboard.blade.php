<x-admin-layout title="Dashboard">

    <div class="page-title">Dashboard Admin</div>
    <div class="page-sub">Ringkasan data akademik secara keseluruhan</div>

    {{-- STAT CARDS --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Mahasiswa</div>
            <div class="stat-value">{{ \App\Models\Mahasiswa::count() }}</div>
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Dosen</div>
            <div class="stat-value">{{ \App\Models\Dosen::count() }}</div>
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Mata Kuliah</div>
            <div class="stat-value">{{ \App\Models\MataKuliah::count() }}</div>
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Kelas Jadwal</div>
            <div class="stat-value">{{ \App\Models\Jadwal::count() }}</div>
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Entri KRS</div>
            <div class="stat-value">{{ \App\Models\Krs::count() }}</div>
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </div>
    </div>

    {{-- CHART + POPULAR --}}
    @php
        $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        $jadwalPerHari = \App\Models\Jadwal::selectRaw('hari, count(*) as total')->groupBy('hari')->pluck('total','hari');
        $maxJadwal = $jadwalPerHari->max() ?: 1;

        $matkulPopuler = \App\Models\MataKuliah::withCount('krs')->orderByDesc('krs_count')->take(5)->get();
        $krsAktivitas = \App\Models\Krs::with(['mahasiswa','mataKuliah'])->latest()->take(5)->get();
    @endphp

    <div class="content-grid">
        <div class="card">
            <div class="card-title">Distribusi Jadwal per Hari</div>
            @foreach ($hariList as $hari)
                @php $total = $jadwalPerHari[$hari] ?? 0; @endphp
                <div class="bar-item">
                    <div class="bar-label">
                        <span>{{ $hari }}</span>
                        <span>{{ $total }} kelas</span>
                    </div>
                    <div class="bar-track">
                        <div class="bar-fill" style="width: {{ $maxJadwal > 0 ? ($total / $maxJadwal * 100) : 0 }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card">
            <div class="card-title">Mata Kuliah Terpopuler</div>
            @forelse ($matkulPopuler as $mk)
                <div class="matkul-item">
                    <div>
                        <div class="matkul-name">{{ $mk->nama_matakuliah }}</div>
                        <div class="matkul-meta">{{ $mk->kode_matakuliah }} · {{ $mk->sks }} SKS</div>
                    </div>
                    <span class="badge">{{ $mk->krs_count }} mhs</span>
                </div>
            @empty
                <p style="color:#666;font-size:13px;">Belum ada data.</p>
            @endforelse
        </div>
    </div>

    {{-- AKTIVITAS KRS --}}
    <div class="card">
        <div class="card-title">Aktivitas KRS Terbaru</div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Mata Kuliah</th>
                        <th>Waktu Pengambilan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($krsAktivitas as $k)
                        <tr>
                            <td>{{ $k->npm }}</td>
                            <td>{{ $k->mahasiswa->nama ?? '-' }}</td>
                            <td>{{ $k->mataKuliah->nama_matakuliah ?? '-' }}</td>
                            <td class="time-ago">{{ $k->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="text-align:center;color:#666;">Belum ada aktivitas KRS.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- EXPORT --}}
    <div class="card" style="margin-top:20px;">
        <div class="card-title">Export Data</div>
        <div style="display:flex;gap:12px;">
            <a href="{{ route('admin.export.krs') }}" style="background:#1a2e1a;color:#4ade80;font-size:13px;padding:10px 20px;border-radius:8px;text-decoration:none;border:1px solid #2a4a2a;display:flex;align-items:center;gap:8px;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Export Data KRS (Excel)
            </a>
        </div>
    </div>

    {{-- GRAFIK CHART.JS --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:20px;">
        <div class="card">
            <div class="card-title">Grafik Mahasiswa per Dosen Wali</div>
            <canvas id="chartDosen"></canvas>
        </div>
        <div class="card">
            <div class="card-title">Grafik Mata Kuliah Terpopuler</div>
            <canvas id="chartMatkul"></canvas>
        </div>
    </div>

    @php
        $statistikDosen = \App\Models\Dosen::withCount('mahasiswa')->orderByDesc('mahasiswa_count')->get();
    @endphp

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('chartDosen'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($statistikDosen->pluck('nama')) !!},
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: {!! json_encode($statistikDosen->pluck('mahasiswa_count')) !!},
                    backgroundColor: '#c9a84c',
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: { legend: { labels: { color: '#aaa' } } },
                scales: {
                    x: { ticks: { color: '#666' }, grid: { color: '#1a1a1a' } },
                    y: { ticks: { color: '#666' }, grid: { color: '#2a2a2a' }, beginAtZero: true }
                }
            }
        });

        new Chart(document.getElementById('chartMatkul'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($matkulPopuler->pluck('nama_matakuliah')) !!},
                datasets: [{
                    label: 'Jumlah Pengambil',
                    data: {!! json_encode($matkulPopuler->pluck('krs_count')) !!},
                    backgroundColor: '#10b981',
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: { legend: { labels: { color: '#aaa' } } },
                scales: {
                    x: { ticks: { color: '#666' }, grid: { color: '#1a1a1a' } },
                    y: { ticks: { color: '#666' }, grid: { color: '#2a2a2a' }, beginAtZero: true }
                }
            }
        });
    </script>

</x-admin-layout>