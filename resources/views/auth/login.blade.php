<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0f0f;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            display: flex;
            width: 900px;
            min-height: 520px;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #1a2e2e;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
        }

        /* PANEL KIRI */
        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #0f1a1a 0%, #0a2e2e 100%);
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(45,212,191,0.08) 0%, transparent 70%);
            top: -50px;
            right: -80px;
            border-radius: 50%;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(45,212,191,0.05) 0%, transparent 70%);
            bottom: 40px;
            left: -40px;
            border-radius: 50%;
        }
        .brand { position: relative; z-index: 1; }
        .brand-icon {
            width: 48px;
            height: 48px;
            background: #2dd4bf;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #000;
            font-size: 22px;
            margin-bottom: 16px;
        }
        .brand-title { font-size: 26px; font-weight: 800; color: #fff; margin-bottom: 8px; }
        .brand-sub { font-size: 13px; color: #4a7a7a; line-height: 1.6; }

        .features { position: relative; z-index: 1; }
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
        }
        .feature-icon {
            width: 32px;
            height: 32px;
            background: #0a2e2e;
            border: 1px solid #1a4a4a;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .feature-icon svg { width: 15px; height: 15px; color: #2dd4bf; }
        .feature-text-title { font-size: 13px; font-weight: 600; color: #e0e0e0; }
        .feature-text-sub { font-size: 12px; color: #4a7a7a; margin-top: 2px; }

        .left-footer { font-size: 11px; color: #2a4a4a; position: relative; z-index: 1; }

        /* PANEL KANAN */
        .right-panel {
            width: 380px;
            background: #0f1a1a;
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-left: 1px solid #1a2e2e;
        }
        .login-title { font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 6px; }
        .login-sub { font-size: 13px; color: #4a7a7a; margin-bottom: 32px; }

        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 12px; color: #aaa; margin-bottom: 7px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-input {
            width: 100%;
            background: #0a1515;
            border: 1px solid #1a2e2e;
            color: #eee;
            padding: 11px 14px;
            border-radius: 9px;
            font-size: 13px;
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
        }
        .form-input:focus {
            border-color: #2dd4bf;
            box-shadow: 0 0 0 3px rgba(45,212,191,0.08);
        }
        .form-input::placeholder { color: #2a4a4a; }
        .form-error { color: #e05252; font-size: 12px; margin-top: 5px; }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .remember-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: #4a7a7a;
            cursor: pointer;
        }
        .remember-label input[type="checkbox"] { accent-color: #2dd4bf; width: 14px; height: 14px; }
        .forgot-link { font-size: 12px; color: #2dd4bf; text-decoration: none; }
        .forgot-link:hover { text-decoration: underline; }

        .btn-login {
            width: 100%;
            background: #2dd4bf;
            color: #000;
            font-weight: 700;
            font-size: 14px;
            padding: 12px;
            border-radius: 9px;
            border: none;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s;
            letter-spacing: 0.3px;
        }
        .btn-login:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }

        .divider { border: none; border-top: 1px solid #1a2e2e; margin: 24px 0; }

        .demo-accounts { background: #0a1515; border: 1px solid #1a2e2e; border-radius: 10px; padding: 14px 16px; }
        .demo-title { font-size: 11px; color: #4a7a7a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
        .demo-item { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
        .demo-item:last-child { margin-bottom: 0; }
        .demo-role { font-size: 12px; color: #aaa; }
        .demo-badge {
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 99px;
            font-weight: 600;
        }
        .demo-badge.admin { background: #252000; color: #c9a84c; }
        .demo-badge.mhs { background: #0a2e2e; color: #2dd4bf; }
        .demo-email { font-size: 11px; color: #2a4a4a; }

        /* RESPONSIVE */
        @media (max-width: 700px) {
            .login-wrapper { flex-direction: column; width: 95%; }
            .left-panel { padding: 32px 28px; }
            .features { display: none; }
            .right-panel { width: 100%; padding: 32px 28px; border-left: none; border-top: 1px solid #1a2e2e; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    {{-- PANEL KIRI --}}
    <div class="left-panel">
        <div class="brand">
            <div class="brand-icon">S</div>
            <div class="brand-title">SIAKAD</div>
            <div class="brand-sub">Sistem Informasi Akademik<br>Sederhana — Web II IF53413</div>
        </div>

        <div class="features">
            <div class="feature-item">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <div class="feature-text-title">Role-Based Access</div>
                    <div class="feature-text-sub">Admin & mahasiswa dengan hak akses berbeda</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <div class="feature-text-title">Manajemen KRS</div>
                    <div class="feature-text-sub">Ambil & drop mata kuliah dengan mudah</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <div class="feature-text-title">Jadwal Perkuliahan</div>
                    <div class="feature-text-sub">Lihat jadwal dosen, kelas, hari & jam</div>
                </div>
            </div>
        </div>

        <div class="left-footer">© 2026 SIAKAD — Tugas Besar Web II</div>
    </div>

    {{-- PANEL KANAN --}}
    <div class="right-panel">
        <div class="login-title">Selamat Datang</div>
        <div class="login-sub">Masuk ke akun SIAKAD kamu</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="nama@email.com" autofocus autocomplete="username">
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="••••••••" autocomplete="current-password">
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="remember-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                @endif
            </div>

            <button type="submit" class="btn-login">MASUK</button>
        </form>

        <hr class="divider">

        <div class="demo-accounts">
            <div class="demo-title">Akun Demo</div>
            <div class="demo-item">
                <div>
                    <div class="demo-role">admin@siakad.com</div>
                    <div class="demo-email">password: password</div>
                </div>
                <span class="demo-badge admin">Admin</span>
            </div>
            <div class="demo-item">
                <div>
                    <div class="demo-role">queen@siakad.com</div>
                    <div class="demo-email">password: password</div>
                </div>
                <span class="demo-badge mhs">Mahasiswa</span>
            </div>
        </div>
    </div>

</div>

</body>
</html>