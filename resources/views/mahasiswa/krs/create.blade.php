<x-mahasiswa-layout title="Ambil Mata Kuliah">

    <div class="page-title">Ambil Mata Kuliah</div>
    <div class="page-sub">Tambahkan mata kuliah ke KRS kamu</div>

    <div class="page-card" style="max-width:520px;">
        @if ($matakuliah->isEmpty())
            <p style="color:#4a7a7a;font-size:13px;">Semua mata kuliah sudah kamu ambil atau tidak ada mata kuliah tersedia.</p>
            <a href="{{ route('mahasiswa.krs.index') }}" class="btn-secondary" style="margin-top:14px;display:inline-block;">← Kembali ke KRS</a>
        @else
            <form action="{{ route('mahasiswa.krs.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Pilih Mata Kuliah</label>
                    <select name="kode_matakuliah" class="form-select">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach ($matakuliah as $mk)
                            <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                                {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                            </option>
                        @endforeach
                    </select>
                    @error('kode_matakuliah') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div style="display:flex;gap:10px;margin-top:8px;">
                    <button type="submit" class="btn-primary">Ambil</button>
                    <a href="{{ route('mahasiswa.krs.index') }}" class="btn-secondary">Batal</a>
                </div>
            </form>
        @endif
    </div>

</x-mahasiswa-layout>