<x-admin-layout title="Tambah Mahasiswa">

    <div class="page-title">Tambah Mahasiswa</div>
    <div class="page-sub">Tambah data mahasiswa baru</div>

    <div class="page-card" style="max-width:520px;">
        <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">NPM</label>
                <input type="text" name="npm" value="{{ old('npm') }}" maxlength="10" class="form-input" placeholder="10 digit NPM">
                @error('npm') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="form-input" placeholder="Nama lengkap">
                @error('nama') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Dosen Wali</label>
                <select name="nidn" class="form-select">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach ($dosen as $d)
                        <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
                    @endforeach
                </select>
                @error('nidn') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div style="display:flex;gap:10px;margin-top:8px;">
                <button type="submit" class="btn-primary">Simpan</button>
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>

</x-admin-layout>