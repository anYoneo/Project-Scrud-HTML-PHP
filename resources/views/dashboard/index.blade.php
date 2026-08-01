@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#0d6efd,#0056b3)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $stats['total'] }}</div>
                    <div class="stat-label">Total Pendaftar</div>
                </div>
                <i class="bi bi-people" style="font-size:2.5rem;opacity:.4"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#ffc107,#e0a800)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $stats['pending'] }}</div>
                    <div class="stat-label">Menunggu Verifikasi</div>
                </div>
                <i class="bi bi-clock" style="font-size:2.5rem;opacity:.4"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#198754,#145a32)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $stats['diterima'] }}</div>
                    <div class="stat-label">Diterima</div>
                </div>
                <i class="bi bi-check-circle" style="font-size:2.5rem;opacity:.4"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#dc3545,#a71d2a)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $stats['ditolak'] }}</div>
                    <div class="stat-label">Ditolak</div>
                </div>
                <i class="bi bi-x-circle" style="font-size:2.5rem;opacity:.4"></i>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clock-history me-2"></i>Pendaftaran Terbaru</span>
        <a href="{{ route('peserta.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>No. Daftar</th><th>Nama Peserta</th><th>Jurusan</th><th>Tgl Daftar</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                @forelse($recentPendaftaran as $p)
                <tr>
                    <td><code>{{ $p->nomor_pendaftaran }}</code></td>
                    <td>{{ $p->nama_peserta }}</td>
                    <td>{{ $p->jurusan }}</td>
                    <td>{{ $p->tanggal_daftar->format('d/m/Y') }}</td>
                    <td>
                        @php $badge = ['pending'=>'warning','diterima'=>'success','ditolak'=>'danger'][$p->status] @endphp
                        <span class="badge bg-{{ $badge }}">{{ ucfirst($p->status) }}</span>
                    </td>
                    <td><a href="{{ route('peserta.show',$p) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data pendaftaran</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
