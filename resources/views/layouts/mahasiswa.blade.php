<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - {{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0a0f0f; color: #e0e0e0; display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: 220px; min-height: 100vh; background: #0f1a1a; display: flex; flex-direction: column; padding: 20px 0; position: fixed; top: 0; left: 0; bottom: 0; border-right: 1px solid #1a2e2e; }
        .sidebar-logo { padding: 0 20px 24px; border-bottom: 1px solid #1a2e2e; }
        .sidebar-logo .logo-icon { width: 36px; height: 36px; background: #2dd4bf; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #000; font-size: 16px; margin-bottom: 8px; }
        .sidebar-logo .logo-title { font-size: 15px; font-weight: 700; color: #fff; }
        .sidebar-logo .logo-sub { font-size: 11px; color: #888; }
        .sidebar-nav { flex: 1; padding: 16px 12px; }
        .nav-group-label { font-size: 10px; text-transform: uppercase; color: #4a7a7a; letter-spacing: 1px; margin: 16px 8px 6px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; color: #aaa; text-decoration: none; font-size: 13.5px; margin-bottom: 2px; transition: all 0.2s; }
        .nav-item:hover { background: #152525; color: #fff; }
        .nav-item.active { background: #0a2e2e; color: #2dd4bf; }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
        .sidebar-footer { padding: 16px 20px; border-top: 1px solid #1a2e2e; }
        .user-info { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
        .user-avatar { width: 32px; height: 32px; background: #2dd4bf; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #000; font-size: 13px; }
        .user-name { font-size: 13px; font-weight: 600; color: #fff; }
        .user-role { font-size: 11px; color: #888; }
        .logout-btn { display: flex; align-items: center; gap: 8px; color: #888; font-size: 13px; text-decoration: none; padding: 8px 0; transition: color 0.2s; cursor: pointer; background: none; border: none; width: 100%; }
        .logout-btn:hover { color: #2dd4bf; }

        /* MAIN */
        .main { margin-left: 220px; flex: 1; padding: 32px; min-height: 100vh; }
        .page-title { font-size: 24px; font-weight: 700; color: #fff; margin-bottom: 4px; }
        .page-sub { font-size: 13px; color: #888; margin-bottom: 28px; }

        /* STAT CARDS */
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 28px; }
        .stat-card { background: #0f1a1a; border: 1px solid #1a2e2e; border-radius: 12px; padding: 18px; display: flex; flex-direction: column; gap: 10px; }
        .stat-label { font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: #4a7a7a; }
        .stat-value { font-size: 32px; font-weight: 700; color: #fff; line-height: 1; }
        .stat-icon { width: 32px; height: 32px; background: #0a2e2e; border-radius: 8px; display: flex; align-items: center; justify-content: center; align-self: flex-end; }
        .stat-icon svg { width: 16px; height: 16px; color: #2dd4bf; }

        /* CARD */
        .card { background: #0f1a1a; border: 1px solid #1a2e2e; border-radius: 12px; padding: 22px; margin-bottom: 20px; }
        .card-title { font-size: 15px; font-weight: 600; color: #fff; margin-bottom: 18px; }
        .page-card { background: #0f1a1a; border: 1px solid #1a2e2e; border-radius: 12px; padding: 24px; }

        /* INFO BOX (profil) */
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .info-item { background: #0a1515; border: 1px solid #1a2e2e; border-radius: 8px; padding: 14px 16px; }
        .info-item-label { font-size: 11px; color: #4a7a7a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .info-item-value { font-size: 14px; color: #e0e0e0; font-weight: 500; }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; }
        table th { text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #4a7a7a; padding: 10px 14px; border-bottom: 1px solid #1a2e2e; background: #0a1515; }
        table td { padding: 12px 14px; font-size: 13px; color: #bbb; border-bottom: 1px solid #111f1f; }
        table tr:hover td { background: #0d1e1e; }

        /* BADGE */
        .badge-teal { background: #0a2e2e; color: #2dd4bf; font-size: 11px; padding: 3px 10px; border-radius: 99px; font-weight: 600; }
        .badge-gray { background: #1a1a1a; color: #888; font-size: 11px; padding: 3px 10px; border-radius: 99px; }

        /* SKS PROGRESS */
        .sks-bar-wrap { margin-bottom: 20px; }
        .sks-bar-info { display: flex; justify-content: space-between; font-size: 13px; color: #aaa; margin-bottom: 8px; }
        .sks-bar-info span:last-child { color: #2dd4bf; font-weight: 600; }
        .sks-track { height: 8px; background: #1a2e2e; border-radius: 99px; overflow: hidden; }
        .sks-fill { height: 100%; background: linear-gradient(90deg, #2dd4bf, #0891b2); border-radius: 99px; transition: width 0.8s ease; }

        /* FORM */
        .form-label { display: block; font-size: 13px; color: #aaa; margin-bottom: 6px; }
        .form-input, .form-select { width: 100%; background: #0a1515; border: 1px solid #1a2e2e; color: #eee; padding: 9px 12px; border-radius: 8px; font-size: 13px; outline: none; transition: border 0.2s; }
        .form-input:focus, .form-select:focus { border-color: #2dd4bf; }
        .form-group { margin-bottom: 18px; }
        .form-error { color: #e05252; font-size: 12px; margin-top: 4px; }
        .btn-primary { background: #2dd4bf; color: #000; font-weight: 600; font-size: 13px; padding: 9px 20px; border-radius: 8px; border: none; cursor: pointer; transition: opacity 0.2s; text-decoration: none; display: inline-block; }
        .btn-primary:hover { opacity: 0.85; }
        .btn-secondary { background: #152525; color: #aaa; font-size: 13px; padding: 9px 20px; border-radius: 8px; border: 1px solid #1a2e2e; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-danger { background: #2a0f0f; color: #e05252; font-size: 12px; padding: 5px 12px; border-radius: 6px; border: 1px solid #5c1e1e; cursor: pointer; transition: all 0.2s; }
        .btn-danger:hover { background: #3a1010; }

        /* ALERT */
        .alert-success { background: #0a2e1a; border: 1px solid #1a5c2e; color: #4ade80; padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; }
        .alert-error { background: #2a0f0f; border: 1px solid #5c1e1e; color: #e05252; padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; }

        /* TOOLBAR */
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 12px; }

        /* MENU GRID */
        .menu-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; margin-top: 8px; }
        .menu-card { background: #0a1515; border: 1px solid #1a2e2e; border-radius: 10px; padding: 18px; text-decoration: none; display: flex; align-items: center; gap: 14px; transition: all 0.2s; }
        .menu-card:hover { border-color: #2dd4bf; background: #0d1e1e; }
        .menu-card-icon { width: 40px; height: 40px; background: #0a2e2e; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .menu-card-icon svg { width: 20px; height: 20px; color: #2dd4bf; }
        .menu-card-title { font-size: 14px; font-weight: 600; color: #fff; }
        .menu-card-sub { font-size: 12px; color: #4a7a7a; margin-top: 2px; }

        /* PAGINATION */
        .pagination-wrap { margin-top: 16px; }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">S</div>
        <div class="logo-title">SIAKAD</div>
        <div class="logo-sub">Portal Mahasiswa</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-group-label">Menu Utama</div>
        <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>

        <div class="nav-group-label">Akademik</div>
        <a href="{{ route('mahasiswa.jadwal') }}" class="nav-item {{ request()->routeIs('mahasiswa.jadwal') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Jadwal Kuliah
        </a>
        <a href="{{ route('mahasiswa.krs.index') }}" class="nav-item {{ request()->routeIs('mahasiswa.krs.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            KRS Saya
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ auth()->user()->npm ?? 'Mahasiswa' }}</div>
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

{{-- MAIN --}}
<main class="main">
    {{ $slot }}
</main>

</body>
</html>