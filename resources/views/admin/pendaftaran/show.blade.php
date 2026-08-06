@extends('layouts.app')
@section('title', 'Detail Pendaftaran')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-badge"></i> Detail Pendaftaran</h2>
    <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white fw-bold">Data Lengkap Pendaftar</div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <table class="table table-borderless table-sm">
                            <tr><td width="40%" class="text-muted">Nomor Pendaftaran</td><td>:</td><td class="fw-bold">{{ $pendaftaran->nomor_pendaftaran }}</td></tr>
                            <tr><td class="text-muted">Nama Lengkap</td><td>:</td><td>{{ $pendaftaran->nama_peserta }}</td></tr>
                            <tr><td class="text-muted">TTL</td><td>:</td><td>{{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir }}</td></tr>
                            <tr><td class="text-muted">Jenis Kelamin</td><td>:</td><td>{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                            <tr><td class="text-muted">Agama</td><td>:</td><td>{{ $pendaftaran->agama }}</td></tr>
                            <tr><td class="text-muted">Alamat</td><td>:</td><td>{{ $pendaftaran->alamat }}</td></tr>
                            <tr><td class="text-muted">No. Telepon</td><td>:</td><td>{{ $pendaftaran->telepon }}</td></tr>
                            <tr><td class="text-muted">Email</td><td>:</td><td>{{ $pendaftaran->email ?? '-' }}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-4 text-center">
                        @if($pendaftaran->foto)
                            <img src="{{ Storage::url($pendaftaran->foto) }}" alt="Foto Peserta" class="img-thumbnail" style="max-height: 150px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center border" style="height: 150px; width: 110px; margin: 0 auto;">
                                <span class="text-muted small">Tanpa Foto</span>
                            </div>
                        @endif
                        <p class="mt-2 text-muted small">Status saat ini:</p>
                        @if($pendaftaran->status == 'pending') <span class="badge badge-pending px-3 py-2 fs-6">Pending</span>
                        @elseif($pendaftaran->status == 'verified') <span class="badge badge-verified px-3 py-2 fs-6">Verified</span>
                        @elseif($pendaftaran->status == 'accepted' || $pendaftaran->status == 'diterima') <span class="badge badge-accepted px-3 py-2 fs-6">Accepted</span>
                        @elseif($pendaftaran->status == 'rejected' || $pendaftaran->status == 'ditolak') <span class="badge badge-rejected px-3 py-2 fs-6">Rejected</span>
                        @endif
                    </div>
                </div>

                <h6 class="border-bottom pb-2 text-primary">Data Akademik</h6>
                <table class="table table-borderless table-sm mb-4">
                    <tr><td width="30%" class="text-muted">Asal Sekolah</td><td>:</td><td>{{ $pendaftaran->asal_sekolah }}</td></tr>
                    <tr><td class="text-muted">Jurusan Dipilih</td><td>:</td><td class="fw-bold">{{ $pendaftaran->jurusan->nama_jurusan ?? $pendaftaran->jurusan }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold">Update Status</div>
            <div class="card-body">
                <form action="{{ route('admin.pendaftaran.updateStatus', $pendaftaran->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label">Pilih Status Baru</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="verified" {{ $pendaftaran->status == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="accepted" {{ $pendaftaran->status == 'accepted' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ $pendaftaran->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Alasan penolakan / info lainnya">{{ $pendaftaran->catatan_admin }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save"></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>

        @if(isset($pendaftaran->verifier_id))
        <div class="card mb-4 bg-light">
            <div class="card-body p-3">
                <h6 class="fw-bold text-muted mb-2"><i class="bi bi-clock-history"></i> Log Verifikasi</h6>
                <p class="mb-0 small">
                    Diverifikasi oleh: <strong>{{ $pendaftaran->verifier->name ?? 'Admin' }}</strong><br>
                    Pada: {{ $pendaftaran->updated_at->format('d M Y H:i') }}
                </p>
            </div>
        </div>
        @endif

        <div class="card border-danger">
            <div class="card-body p-3">
                <form action="{{ route('admin.pendaftaran.destroy', $pendaftaran->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftaran ini secara permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100"><i class="bi bi-trash"></i> Hapus Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
