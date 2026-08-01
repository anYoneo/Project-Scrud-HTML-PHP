@extends('layouts.app')
@section('title', 'Daftar Peserta Baru')
@section('page-title', 'Formulir Pendaftaran')

@section('content')
<div class="card">
    <div class="card-header"><i class="bi bi-person-plus me-2"></i>Formulir Pendaftaran Siswa Baru</div>
    <div class="card-body">
        <form action="{{ route('peserta.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" placeholder="2024/2025" value="{{ old('tahun_ajaran') }}">
                    @error('tahun_ajaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jurusan</label>
                    <select name="jurusan" class="form-select @error('jurusan') is-invalid @enderror">
                        <option value="">Pilih Jurusan</option>
                        @foreach(['Teknik Otomotif','Teknik Las','Teknik Elektronika','Teknik Komputer Jaringan','Akuntansi','Administrasi Perkantoran'] as $j)
                        <option value="{{ $j }}" {{ old('jurusan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                    @error('jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Nama Lengkap Peserta</label>
                    <input type="text" name="nama_peserta" class="form-control @error('nama_peserta') is-invalid @enderror" value="{{ old('nama_peserta') }}">
                    @error('nama_peserta')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">Pilih</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Agama</label>
                    <select name="agama" class="form-select @error('agama') is-invalid @enderror">
                        <option value="">Pilih Agama</option>
                        @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                        <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                        @endforeach
                    </select>
                    @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kecamatan</label>
                    <select name="kecamatan_id" class="form-select @error('kecamatan_id') is-invalid @enderror">
                        <option value="">Pilih Kecamatan</option>
                        @foreach($kecamatans as $k)
                        <option value="{{ $k->id }}" {{ old('kecamatan_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kecamatan }}</option>
                        @endforeach
                    </select>
                    @error('kecamatan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">No. Telepon/HP</label>
                    <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}">
                    @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Asal Sekolah</label>
                    <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" value="{{ old('asal_sekolah') }}">
                    @error('asal_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pas Foto <small class="text-muted">(JPG/PNG, max 2MB)</small></label>
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/jpeg,image/png">
                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan Pendaftaran</button>
                <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
