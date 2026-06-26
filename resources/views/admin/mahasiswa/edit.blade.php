<x-admin-layout title="Edit Mahasiswa">

    <div class="page-title">Edit Mahasiswa</div>
    <div class="page-sub">Ubah data mahasiswa</div>

    <div class="page-card" style="max-width:520px;">
        <form action="{{ route('admin.mahasiswa.update', $mahasiswa->npm) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">NPM</label>
                <input type="text" name="npm" value="{{ old('npm', $mahasiswa->npm) }}" maxlength="10" class="form-input">
                @error('npm') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" class="form-input">
                @error('nama') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Dosen Wali</label>
                <select name="nidn" class="form-select">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach ($dosen as $d)
                        <option value="{{ $d->nidn }}" {{ old('nidn', $mahasiswa->nidn) == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
                    @endforeach
                </select>
                @error('nidn') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div style="display:flex;gap:10px;margin-top:8px;">
                <button type="submit" class="btn-primary">Update</button>
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>

</x-admin-layout>