<x-mahasiswa-layout title="Profil Saya">

    <div class="page-title">Profil Saya</div>
    <div class="page-sub">Kelola informasi akun kamu</div>

    @if (session('status') === 'profile-updated')
        <div class="alert-success">Profil berhasil diperbarui.</div>
    @endif

    {{-- UPDATE PROFILE --}}
    <div class="page-card" style="max-width:560px;margin-bottom:20px;">
        <div class="card-title">Informasi Profil</div>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf @method('PATCH')
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input">
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input">
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    {{-- UPDATE PASSWORD --}}
    <div class="page-card" style="max-width:560px;margin-bottom:20px;">
        <div class="card-title">Ubah Password</div>

        @if (session('status') === 'password-updated')
            <div class="alert-success" style="margin-bottom:16px;">Password berhasil diperbarui.</div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Password Saat Ini</label>
                <input type="password" name="current_password" class="form-input" autocomplete="current-password">
                @error('current_password') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-input" autocomplete="new-password">
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-input" autocomplete="new-password">
                @error('password_confirmation') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn-primary">Ubah Password</button>
        </form>
    </div>

    {{-- DELETE ACCOUNT --}}
    <div class="page-card" style="max-width:560px;border:1px solid #3a1a1a;">
        <div class="card-title" style="color:#e05252;">Hapus Akun</div>
        <p style="font-size:13px;color:#666;margin-bottom:16px;">Setelah akun dihapus, semua data akan dihapus permanen.</p>
        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Yakin hapus akun? Tindakan ini tidak bisa dibatalkan.')">
            @csrf @method('DELETE')
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password" class="form-input" style="border-color:#3a1a1a;">
                @error('password', 'userDeletion') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <button type="submit" style="background:#2a0f0f;color:#e05252;font-size:13px;padding:9px 20px;border-radius:8px;border:1px solid #5c1e1e;cursor:pointer;">
                Hapus Akun Saya
            </button>
        </form>
    </div>

</x-mahasiswa-layout>