<x-mahasiswa-layout title="Dashboard">

    <div class="page-title">Selamat Datang, {{ auth()->user()->name }} 👋</div>
    <div class="page-sub">Portal akademik mahasiswa SIAKAD</div>

    @php
        $npm = auth()->user()->npm;
        $mahasiswa = \App\Models\Mahasiswa::with('dosen')->find($npm);
        $totalKrs = \App\Models\Krs::where('npm', $npm)->count();
        $totalSks = \App\Models\Krs::where('npm', $npm)->with('mataKuliah')->get()->sum(fn($k) => $k->mataKuliah->sks ?? 0);
        $totalJadwal = \App\Models\Jadwal::count();
    @endphp

    {{-- STAT CARDS --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Mata Kuliah Diambil</div>
            <div class="stat-value">{{ $totalKrs }}</div>
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total SKS</div>
            <div class="stat-value">{{ $totalSks }}</div>
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Jadwal Tersedia</div>
            <div class="stat-value">{{ $totalJadwal }}</div>
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
    </div>

    {{-- PROFIL + MENU --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

        {{-- Info Profil --}}
        <div class="card">
            <div class="card-title">Informasi Mahasiswa</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-item-label">NPM</div>
                    <div class="info-item-value">{{ $mahasiswa->npm ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">Nama</div>
                    <div class="info-item-value">{{ $mahasiswa->nama ?? '-' }}</div>
                </div>
                <div class="info-item" style="grid-column:span 2;">
                    <div class="info-item-label">Dosen Wali</div>
                    <div class="info-item-value">{{ $mahasiswa->dosen->nama ?? '-' }}</div>
                </div>
            </div>

            {{-- Progress SKS --}}
            <div class="sks-bar-wrap" style="margin-top:18px;">
                <div class="sks-bar-info">
                    <span>Progres SKS</span>
                    <span>{{ $totalSks }} / 24 SKS</span>
                </div>
                <div class="sks-track">
                    <div class="sks-fill" style="width: {{ min(($totalSks / 24) * 100, 100) }}%"></div>
                </div>
            </div>
        </div>

        {{-- Menu Cepat --}}
        <div class="card">
            <div class="card-title">Menu Cepat</div>
            <div class="menu-grid">
                <a href="{{ route('mahasiswa.krs.index') }}" class="menu-card">
                    <div class="menu-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <div class="menu-card-title">KRS Saya</div>
                        <div class="menu-card-sub">Lihat & kelola KRS</div>
                    </div>
                </a>
                <a href="{{ route('mahasiswa.krs.create') }}" class="menu-card">
                    <div class="menu-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <div>
                        <div class="menu-card-title">Ambil Mata Kuliah</div>
                        <div class="menu-card-sub">Input KRS baru</div>
                    </div>
                </a>
                <a href="{{ route('mahasiswa.jadwal') }}" class="menu-card">
                    <div class="menu-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <div class="menu-card-title">Jadwal Kuliah</div>
                        <div class="menu-card-sub">Lihat semua jadwal</div>
                    </div>
                </a>
                <a href="{{ route('profile.edit') }}" class="menu-card">
                    <div class="menu-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <div class="menu-card-title">Profil</div>
                        <div class="menu-card-sub">Edit akun saya</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

</x-mahasiswa-layout>