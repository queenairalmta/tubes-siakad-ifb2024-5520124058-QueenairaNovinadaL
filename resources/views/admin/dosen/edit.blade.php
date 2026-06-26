<x-admin-layout title="Edit Dosen">

    <div class="page-title">Edit Dosen</div>
    <div class="page-sub">Ubah data dosen</div>

    <div class="page-card" style="max-width:520px;">
        <form action="{{ route('admin.dosen.update', $dosen->nidn) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">NIDN</label>
                <input type="text" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" maxlength="10" class="form-input">
                @error('nidn') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Nama Dosen</label>
                <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}" class="form-input">
                @error('nama') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div style="display:flex;gap:10px;margin-top:8px;">
                <button type="submit" class="btn-primary">Update</button>
                <a href="{{ route('admin.dosen.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>

</x-admin-layout>