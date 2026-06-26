<x-admin-layout title="Tambah Mata Kuliah">

    <div class="page-title">Tambah Mata Kuliah</div>
    <div class="page-sub">Tambah data mata kuliah baru</div>

    <div class="page-card" style="max-width:520px;">
        <form action="{{ route('admin.matakuliah.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Kode Mata Kuliah</label>
                <input type="text" name="kode_matakuliah" value="{{ old('kode_matakuliah') }}" maxlength="8" class="form-input" placeholder="Maks. 8 karakter">
                @error('kode_matakuliah') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah') }}" class="form-input" placeholder="Nama mata kuliah">
                @error('nama_matakuliah') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">SKS</label>
                <input type="number" name="sks" value="{{ old('sks') }}" min="1" max="6" class="form-input" placeholder="1 - 6">
                @error('sks') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div style="display:flex;gap:10px;margin-top:8px;">
                <button type="submit" class="btn-primary">Simpan</button>
                <a href="{{ route('admin.matakuliah.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>

</x-admin-layout>