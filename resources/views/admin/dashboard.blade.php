@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
    <span class="text-muted">Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</span>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card info p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Pendaftar</h6>
                    <h3 class="mb-0">{{ $stats['total'] ?? 0 }}</h3>
                </div>
                <i class="bi bi-people display-6 text-info opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card warning p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Pending</h6>
                    <h3 class="mb-0">{{ $stats['pending'] ?? 0 }}</h3>
                </div>
                <i class="bi bi-hourglass-split display-6 text-warning opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card success p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Diterima</h6>
                    <h3 class="mb-0">{{ $stats['accepted'] ?? 0 }}</h3>
                </div>
                <i class="bi bi-check-circle display-6 text-success opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card danger p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Ditolak</h6>
                    <h3 class="mb-0">{{ $stats['rejected'] ?? 0 }}</h3>
                </div>
                <i class="bi bi-x-circle display-6 text-danger opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card">
            <div class="card-header bg-white fw-bold">Kuota Jurusan</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Jurusan</th>
                            <th class="text-center">Kuota</th>
                            <th class="text-center">Terisi</th>
                            <th class="text-center">Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($jurusans))
                            @foreach($jurusans as $j)
                            <tr>
                                <td>{{ $j->nama_jurusan }}</td>
                                <td class="text-center">{{ $j->kuota }}</td>
                                <td class="text-center">{{ $j->terisi }}</td>
                                <td class="text-center fw-bold {{ ($j->kuota - $j->terisi) <= 5 ? 'text-danger' : 'text-success' }}">
                                    {{ $j->kuota - $j->terisi }}
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr><td colspan="4" class="text-center text-muted py-3">Data jurusan belum tersedia</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-7 mb-4">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-bold">Pendaftar Terbaru</span>
                <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No. Daftar</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($recentRegistrations) && count($recentRegistrations) > 0)
                                @foreach($recentRegistrations as $reg)
                                <tr>
                                    <td>{{ $reg->nomor_pendaftaran }}</td>
                                    <td>{{ $reg->nama_peserta }}</td>
                                    <td>{{ $reg->jurusan->nama_jurusan ?? '-' }}</td>
                                    <td>
                                        @if($reg->status == 'pending') <span class="badge badge-pending">Pending</span>
                                        @elseif($reg->status == 'verified') <span class="badge badge-verified">Verified</span>
                                        @elseif($reg->status == 'accepted' || $reg->status == 'diterima') <span class="badge badge-accepted">Accepted</span>
                                        @elseif($reg->status == 'rejected' || $reg->status == 'ditolak') <span class="badge badge-rejected">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada data pendaftar</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
