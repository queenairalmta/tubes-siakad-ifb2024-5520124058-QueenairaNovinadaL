<x-admin-layout title="Edit Mata Kuliah">

    <div class="page-title">Edit Mata Kuliah</div>
    <div class="page-sub">Ubah data mata kuliah</div>

    <div class="page-card" style="max-width:520px;">
        <form action="{{ route('admin.matakuliah.update', $matakuliah->kode_matakuliah) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Kode Mata Kuliah</label>
                <input type="text" name="kode_matakuliah" value="{{ old('kode_matakuliah', $matakuliah->kode_matakuliah) }}" maxlength="8" class="form-input">
                @error('kode_matakuliah') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" class="form-input">
                @error('nama_matakuliah') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">SKS</label>
                <input type="number" name="sks" value="{{ old('sks', $matakuliah->sks) }}" min="1" max="6" class="form-input">
                @error('sks') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div style="display:flex;gap:10px;margin-top:8px;">
                <button type="submit" class="btn-primary">Update</button>
                <a href="{{ route('admin.matakuliah.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>

</x-admin-layout>