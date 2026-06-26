<x-admin-layout title="Edit Jadwal">

    <div class="page-title">Edit Jadwal</div>
    <div class="page-sub">Ubah jadwal perkuliahan</div>

    <div class="page-card" style="max-width:520px;">
        <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Mata Kuliah</label>
                <select name="kode_matakuliah" class="form-select">
                    @foreach ($matakuliah as $mk)
                        <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>{{ $mk->nama_matakuliah }}</option>
                    @endforeach
                </select>
                @error('kode_matakuliah') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Dosen Pengajar</label>
                <select name="nidn" class="form-select">
                    @foreach ($dosen as $d)
                        <option value="{{ $d->nidn }}" {{ old('nidn', $jadwal->nidn) == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
                    @endforeach
                </select>
                @error('nidn') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Kelas</label>
                <input type="text" name="kelas" value="{{ old('kelas', $jadwal->kelas) }}" maxlength="1" class="form-input">
                @error('kelas') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Hari</label>
                <select name="hari" class="form-select">
                    @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                        <option value="{{ $h }}" {{ old('hari', $jadwal->hari) == $h ? 'selected' : '' }}>{{ $h }}</option>
                    @endforeach
                </select>
                @error('hari') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Jam</label>
                <input type="time" name="jam" value="{{ old('jam', \Illuminate\Support\Carbon::parse($jadwal->jam)->format('H:i')) }}" class="form-input">
                @error('jam') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div style="display:flex;gap:10px;margin-top:8px;">
                <button type="submit" class="btn-primary">Update</button>
                <a href="{{ route('admin.jadwal.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>

</x-admin-layout>