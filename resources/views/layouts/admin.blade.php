<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - {{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0f0f0f; color: #e0e0e0; display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: 220px; min-height: 100vh; background: #1a1a1a; display: flex; flex-direction: column; padding: 20px 0; position: fixed; top: 0; left: 0; bottom: 0; border-right: 1px solid #2a2a2a; }
        .sidebar-logo { padding: 0 20px 24px; border-bottom: 1px solid #2a2a2a; }
        .sidebar-logo .logo-icon { width: 36px; height: 36px; background: #c9a84c; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #000; font-size: 16px; margin-bottom: 8px; }
        .sidebar-logo .logo-title { font-size: 15px; font-weight: 700; color: #fff; }
        .sidebar-logo .logo-sub { font-size: 11px; color: #888; }
        .sidebar-nav { flex: 1; padding: 16px 12px; }
        .nav-group-label { font-size: 10px; text-transform: uppercase; color: #666; letter-spacing: 1px; margin: 16px 8px 6px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; color: #aaa; text-decoration: none; font-size: 13.5px; margin-bottom: 2px; transition: all 0.2s; }
        .nav-item:hover { background: #252525; color: #fff; }
        .nav-item.active { background: #2a2200; color: #c9a84c; }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
        .sidebar-footer { padding: 16px 20px; border-top: 1px solid #2a2a2a; }
        .user-info { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
        .user-avatar { width: 32px; height: 32px; background: #c9a84c; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #000; font-size: 13px; }
        .user-name { font-size: 13px; font-weight: 600; color: #fff; }
        .user-role { font-size: 11px; color: #888; }
        .logout-btn { display: flex; align-items: center; gap: 8px; color: #888; font-size: 13px; text-decoration: none; padding: 8px 0; transition: color 0.2s; cursor: pointer; background: none; border: none; width: 100%; }
        .logout-btn:hover { color: #c9a84c; }

        /* MAIN CONTENT */
        .main { margin-left: 220px; flex: 1; padding: 32px; min-height: 100vh; }
        .page-title { font-size: 24px; font-weight: 700; color: #fff; margin-bottom: 4px; }
        .page-sub { font-size: 13px; color: #888; margin-bottom: 28px; }

        /* STAT CARDS */
        .stats-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 14px; margin-bottom: 28px; }
        .stat-card { background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 12px; padding: 18px; display: flex; flex-direction: column; gap: 10px; }
        .stat-label { font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: #888; }
        .stat-value { font-size: 32px; font-weight: 700; color: #fff; line-height: 1; }
        .stat-icon { width: 32px; height: 32px; background: #252000; border-radius: 8px; display: flex; align-items: center; justify-content: center; align-self: flex-end; }
        .stat-icon svg { width: 16px; height: 16px; color: #c9a84c; }

        /* CONTENT AREA */
        .content-grid { display: grid; grid-template-columns: 1fr 380px; gap: 20px; margin-bottom: 20px; }
        .card { background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 12px; padding: 22px; }
        .card-title { font-size: 15px; font-weight: 600; color: #fff; margin-bottom: 18px; }

        /* BAR CHART */
        .bar-item { margin-bottom: 14px; }
        .bar-label { display: flex; justify-content: space-between; font-size: 12px; color: #aaa; margin-bottom: 5px; }
        .bar-track { height: 6px; background: #2a2a2a; border-radius: 99px; overflow: hidden; }
        .bar-fill { height: 100%; background: #c9a84c; border-radius: 99px; transition: width 1s ease; }

        /* POPULAR LIST */
        .matkul-item { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #222; }
        .matkul-item:last-child { border-bottom: none; }
        .matkul-name { font-size: 13px; font-weight: 500; color: #ddd; }
        .matkul-meta { font-size: 11px; color: #777; }
        .badge { background: #252000; color: #c9a84c; font-size: 11px; padding: 3px 8px; border-radius: 99px; font-weight: 600; }

        /* TABLE */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        table th { text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #666; padding: 10px 14px; border-bottom: 1px solid #2a2a2a; }
        table td { padding: 12px 14px; font-size: 13px; color: #bbb; border-bottom: 1px solid #1f1f1f; }
        table tr:hover td { background: #1f1f1f; }
        .time-ago { color: #666; font-size: 12px; }

        /* PAGE CONTENT CARD (for non-dashboard pages) */
        .page-card { background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 12px; padding: 24px; }

        /* FORM STYLES */
        .form-label { display: block; font-size: 13px; color: #aaa; margin-bottom: 6px; }
        .form-input, .form-select { width: 100%; background: #111; border: 1px solid #333; color: #eee; padding: 9px 12px; border-radius: 8px; font-size: 13px; outline: none; transition: border 0.2s; }
        .form-input:focus, .form-select:focus { border-color: #c9a84c; }
        .form-group { margin-bottom: 18px; }
        .form-error { color: #e05252; font-size: 12px; margin-top: 4px; }
        .btn-primary { background: #c9a84c; color: #000; font-weight: 600; font-size: 13px; padding: 9px 20px; border-radius: 8px; border: none; cursor: pointer; transition: opacity 0.2s; }
        .btn-primary:hover { opacity: 0.85; }
        .btn-secondary { background: #252525; color: #aaa; font-size: 13px; padding: 9px 20px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; display: inline-block; }

        /* FLASH MESSAGE */
        .alert-success { background: #0f2a0f; border: 1px solid #1e5c1e; color: #5cb85c; padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; }
        .alert-error { background: #2a0f0f; border: 1px solid #5c1e1e; color: #e05252; padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; }

        /* DATA TABLE (CRUD) */
        .crud-table th { background: #111; }
        .action-link { color: #c9a84c; font-size: 12px; text-decoration: none; }
        .action-link:hover { text-decoration: underline; }
        .action-delete { color: #e05252; font-size: 12px; background: none; border: none; cursor: pointer; padding: 0; }
        .action-delete:hover { text-decoration: underline; }

        /* SEARCH BAR */
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 12px; }
        .search-box { display: flex; gap: 8px; }
        .search-input { background: #111; border: 1px solid #333; color: #eee; padding: 8px 12px; border-radius: 8px; font-size: 13px; outline: none; width: 220px; }
        .search-input:focus { border-color: #c9a84c; }
        .btn-search { background: #252525; color: #aaa; border: 1px solid #333; padding: 8px 14px; border-radius: 8px; font-size: 13px; cursor: pointer; }
        .btn-add { background: #c9a84c; color: #000; font-weight: 600; font-size: 13px; padding: 8px 16px; border-radius: 8px; text-decoration: none; }

        /* PAGINATION */
        .pagination-wrap { margin-top: 16px; }
        .pagination-wrap nav { color: #888; font-size: 13px; }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
            .content-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">S</div>
        <div class="logo-title">SIAKAD</div>
        <div class="logo-sub">Sistem Informasi Akademik</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-group-label">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>

        <div class="nav-group-label">Manajemen Data</div>
        <a href="{{ route('admin.dosen.index') }}" class="nav-item {{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Dosen
        </a>
        <a href="{{ route('admin.mahasiswa.index') }}" class="nav-item {{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            Mahasiswa
        </a>
        <a href="{{ route('admin.matakuliah.index') }}" class="nav-item {{ request()->routeIs('admin.matakuliah.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Mata Kuliah
        </a>
        <a href="{{ route('admin.jadwal.index') }}" class="nav-item {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Jadwal Kuliah
        </a>

        <div class="nav-group-label">KRS</div>
        <a href="{{ route('admin.krs.index') }}" class="nav-item {{ request()->routeIs('admin.krs.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Lihat KRS Mahasiswa
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

{{-- MAIN CONTENT --}}
<main class="main">
    {{ $slot }}
</main>

</body>
</html>