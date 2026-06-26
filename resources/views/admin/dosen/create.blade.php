<x-admin-layout title="Tambah Dosen">

    <div class="page-title">Tambah Dosen</div>
    <div class="page-sub">Tambah data dosen baru</div>

    <div class="page-card" style="max-width:520px;">
        <form action="{{ route('admin.dosen.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">NIDN</label>
                <input type="text" name="nidn" value="{{ old('nidn') }}" maxlength="10" class="form-input" placeholder="10 digit NIDN">
                @error('nidn') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Nama Dosen</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="form-input" placeholder="Nama lengkap dosen">
                @error('nama') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div style="display:flex;gap:10px;margin-top:8px;">
                <button type="submit" class="btn-primary">Simpan</button>
                <a href="{{ route('admin.dosen.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>

</x-admin-layout>