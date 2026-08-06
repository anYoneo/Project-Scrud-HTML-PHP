@extends('layouts.app')
@section('title', 'Data Pendaftaran')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-list-check"></i> Data Pendaftaran</h2>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.pendaftaran.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Cari Nama/No. Daftar</label>
                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Ketik kata kunci...">
            </div>
            <div class="col-md-3">
                <label class="form-label">Filter Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Diterima</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Filter Jurusan</label>
                <select name="jurusan_id" class="form-select">
                    <option value="">Semua Jurusan</option>
                    @if(isset($jurusans))
                        @foreach($jurusans as $j)
                            <option value="{{ $j->id }}" {{ request('jurusan_id') == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-filter"></i> Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. Daftar</th>
                        <th>Nama Peserta</th>
                        <th>Jurusan</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($pendaftarans) && count($pendaftarans) > 0)
                        @foreach($pendaftarans as $p)
                        <tr>
                            <td>{{ $p->nomor_pendaftaran }}</td>
                            <td>{{ $p->nama_peserta }}</td>
                            <td>{{ $p->jurusan->nama_jurusan ?? '-' }}</td>
                            <td>{{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}</td>
                            <td>
                                @if($p->status == 'pending') <span class="badge badge-pending">Pending</span>
                                @elseif($p->status == 'verified') <span class="badge badge-verified">Verified</span>
                                @elseif($p->status == 'accepted' || $p->status == 'diterima') <span class="badge badge-accepted">Accepted</span>
                                @elseif($p->status == 'rejected' || $p->status == 'ditolak') <span class="badge badge-rejected">Rejected</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.pendaftaran.show', $p->id) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="6" class="text-center text-muted py-4">Data pendaftaran tidak ditemukan.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @if(isset($pendaftarans) && method_exists($pendaftarans, 'links'))
    <div class="card-footer bg-white border-top-0 pt-3">
        {{ $pendaftarans->links() }}
    </div>
    @endif
</div>
@endsection
