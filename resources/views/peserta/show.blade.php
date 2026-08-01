@extends('layouts.app')
@section('title', 'Detail Peserta')
@section('page-title', 'Detail Peserta')

@section('content')
<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-person-badge me-2"></i>{{ $peserta->nama_peserta }}</span>
                @php $badge = ['pending'=>'warning','diterima'=>'success','ditolak'=>'danger'][$peserta->status] @endphp
                <span class="badge bg-{{ $badge }} fs-6">{{ ucfirst($peserta->status) }}</span>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr><th width="35%">No. Pendaftaran</th><td><code class="fs-6">{{ $peserta->nomor_pendaftaran }}</code></td></tr>
                    <tr><th>Tanggal Daftar</th><td>{{ $peserta->tanggal_daftar->format('d F Y') }}</td></tr>
                    <tr><th>Tahun Ajaran</th><td>{{ $peserta->tahun_ajaran }}</td></tr>
                    <tr><th>Jurusan</th><td>{{ $peserta->jurusan }}</td></tr>
                    <tr><th>Nama Lengkap</th><td>{{ $peserta->nama_peserta }}</td></tr>
                    <tr><th>Tempat, Tgl Lahir</th><td>{{ $peserta->tempat_lahir }}, {{ $peserta->tanggal_lahir->format('d F Y') }}</td></tr>
                    <tr><th>Jenis Kelamin</th><td>{{ $peserta->jenis_kelamin }}</td></tr>
                    <tr><th>Agama</th><td>{{ $peserta->agama }}</td></tr>
                    <tr><th>Alamat</th><td>{{ $peserta->alamat }}</td></tr>
                    <tr><th>Kecamatan</th><td>{{ $peserta->kecamatan->nama_kecamatan }}</td></tr>
                    <tr><th>Telepon</th><td>{{ $peserta->telepon ?? '-' }}</td></tr>
                    <tr><th>Asal Sekolah</th><td>{{ $peserta->asal_sekolah ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @if($peserta->foto)
        <div class="card mb-3">
            <div class="card-body text-center">
                <img src="{{ Storage::url($peserta->foto) }}" class="img-fluid rounded" alt="Foto Peserta">
            </div>
        </div>
        @endif
        <div class="card mb-3">
            <div class="card-header">Update Status</div>
            <div class="card-body">
                <form action="{{ route('peserta.status', $peserta) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select mb-2">
                        <option value="pending" {{ $peserta->status=='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diterima" {{ $peserta->status=='diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ $peserta->status=='ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <button type="submit" class="btn btn-primary w-100">Simpan Status</button>
                </form>
            </div>
        </div>
        <div class="d-grid gap-2">
            <a href="{{ route('peserta.edit', $peserta) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i>Edit Data</a>
            <a href="{{ route('laporan.bukti', $peserta) }}" class="btn btn-outline-secondary" target="_blank"><i class="bi bi-printer me-1"></i>Cetak Bukti</a>
            <a href="{{ route('peserta.index') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
            <form action="{{ route('peserta.destroy', $peserta) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-danger w-100"><i class="bi bi-trash me-1"></i>Hapus Data</button>
            </form>
        </div>
    </div>
</div>
@endsection
