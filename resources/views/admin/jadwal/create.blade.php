<x-admin-layout title="Tambah Jadwal">

    <div class="page-title">Tambah Jadwal</div>
    <div class="page-sub">Tambah jadwal perkuliahan baru</div>

    <div class="page-card" style="max-width:520px;">
        <form action="{{ route('admin.jadwal.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Mata Kuliah</label>
                <select name="kode_matakuliah" class="form-select">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach ($matakuliah as $mk)
                        <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>{{ $mk->nama_matakuliah }}</option>
                    @endforeach
                </select>
                @error('kode_matakuliah') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Dosen Pengajar</label>
                <select name="nidn" class="form-select">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach ($dosen as $d)
                        <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
                    @endforeach
                </select>
                @error('nidn') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Kelas</label>
                <input type="text" name="kelas" value="{{ old('kelas') }}" maxlength="1" class="form-input" placeholder="A / B / C">
                @error('kelas') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Hari</label>
                <select name="hari" class="form-select">
                    <option value="">-- Pilih Hari --</option>
                    @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                        <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                    @endforeach
                </select>
                @error('hari') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Jam</label>
                <input type="time" name="jam" value="{{ old('jam') }}" class="form-input">
                @error('jam') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div style="display:flex;gap:10px;margin-top:8px;">
                <button type="submit" class="btn-primary">Simpan</button>
                <a href="{{ route('admin.jadwal.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>

</x-admin-layout>