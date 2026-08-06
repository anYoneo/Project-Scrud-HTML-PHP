@extends('layouts.app')
@section('title', 'Pendaftaran Siswa Baru')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mt-4">
            <div class="card-body p-4">
                <h3 class="mb-4"><i class="bi bi-pencil-square"></i> Formulir Pendaftaran</h3>
                <form action="{{ route('registration.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <h5 class="mb-3 text-primary border-bottom pb-2">Data Diri</h5>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_peserta" class="form-control @error('nama_peserta') is-invalid @enderror" value="{{ old('nama_peserta') }}">
                        @error('nama_peserta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Jenis Kelamin</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jk_l">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jk_p">Perempuan</label>
                        </div>
                        @error('jenis_kelamin') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Agama</label>
                        <select name="agama" class="form-select @error('agama') is-invalid @enderror">
                            <option value="">Pilih Agama</option>
                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $a)
                                <option value="{{ $a }}" {{ old('agama') == $a ? 'selected' : '' }}>{{ $a }}</option>
                            @endforeach
                        </select>
                        @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kecamatan</label>
                        <select name="kecamatan_id" class="form-select @error('kecamatan_id') is-invalid @enderror">
                            <option value="">Pilih Kecamatan</option>
                            @foreach($kecamatans as $k)
                                <option value="{{ $k->id }}" {{ old('kecamatan_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">No. Telepon/HP</label>
                            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}">
                            @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email (Opsional)</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <h5 class="mb-3 mt-4 text-primary border-bottom pb-2">Data Orang Tua / Wali</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Wali</label>
                            <input type="text" name="nama_wali" class="form-control @error('nama_wali') is-invalid @enderror" value="{{ old('nama_wali') }}">
                            @error('nama_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Telepon Wali</label>
                            <input type="text" name="telepon_wali" class="form-control @error('telepon_wali') is-invalid @enderror" value="{{ old('telepon_wali') }}">
                            @error('telepon_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <h5 class="mb-3 mt-4 text-primary border-bottom pb-2">Data Akademik</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" value="{{ old('asal_sekolah') }}">
                            @error('asal_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nilai Rata-rata</label>
                            <input type="number" step="0.01" name="nilai_rata_rata" class="form-control @error('nilai_rata_rata') is-invalid @enderror" value="{{ old('nilai_rata_rata') }}">
                            @error('nilai_rata_rata') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Jurusan</label>
                        <select name="jurusan_id" class="form-select @error('jurusan_id') is-invalid @enderror">
                            <option value="">-- Pilih Jurusan --</option>
                            @if(isset($jurusanList))
                                @foreach($jurusanList as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }} (Sisa Kuota: {{ $jurusan->kuota - $jurusan->terisi }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('jurusan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <h5 class="mb-3 mt-4 text-primary border-bottom pb-2">Berkas Lampiran</h5>
                    <div class="mb-3">
                        <label class="form-label">Pas Foto (JPG/PNG, max 2MB)</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Ijazah / SKHUN (PDF/JPG, max 5MB)</label>
                        <input type="file" name="ijazah" class="form-control @error('ijazah') is-invalid @enderror">
                        @error('ijazah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-send"></i> Kirim Pendaftaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
