@extends('layouts.app')
@section('title', 'Edit Data Peserta')
@section('page-title', 'Edit Data Peserta')

@section('content')
<div class="card">
    <div class="card-header"><i class="bi bi-pencil me-2"></i>Edit Data: {{ $peserta->nama_peserta }}</div>
    <div class="card-body">
        <form action="{{ route('peserta.update', $peserta) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran', $peserta->tahun_ajaran) }}">
                    @error('tahun_ajaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jurusan</label>
                    <select name="jurusan" class="form-select @error('jurusan') is-invalid @enderror">
                        @foreach(['Teknik Otomotif','Teknik Las','Teknik Elektronika','Teknik Komputer Jaringan','Akuntansi','Administrasi Perkantoran'] as $j)
                        <option value="{{ $j }}" {{ old('jurusan', $peserta->jurusan) == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                    @error('jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama_peserta" class="form-control @error('nama_peserta') is-invalid @enderror" value="{{ old('nama_peserta', $peserta->nama_peserta) }}">
                    @error('nama_peserta')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir', $peserta->tempat_lahir) }}">
                    @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $peserta->tanggal_lahir->format('Y-m-d')) }}">
                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                        <option value="Laki-laki" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Agama</label>
                    <select name="agama" class="form-select @error('agama') is-invalid @enderror">
                        @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                        <option value="{{ $agama }}" {{ old('agama', $peserta->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                        @endforeach
                    </select>
                    @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $peserta->alamat) }}</textarea>
                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kecamatan</label>
                    <select name="kecamatan_id" class="form-select @error('kecamatan_id') is-invalid @enderror">
                        @foreach($kecamatans as $k)
                        <option value="{{ $k->id }}" {{ old('kecamatan_id', $peserta->kecamatan_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kecamatan }}</option>
                        @endforeach
                    </select>
                    @error('kecamatan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $peserta->telepon) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Asal Sekolah</label>
                    <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah', $peserta->asal_sekolah) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Foto <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                    @if($peserta->foto)
                    <div class="mb-2"><img src="{{ Storage::url($peserta->foto) }}" height="80" class="rounded"></div>
                    @endif
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/jpeg,image/png">
                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save me-1"></i>Simpan Perubahan</button>
                <a href="{{ route('peserta.show', $peserta) }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
