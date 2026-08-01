@extends('layouts.app')
@section('title', 'Data Peserta')
@section('page-title', 'Data Peserta')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span><i class="bi bi-people me-2"></i>Daftar Peserta</span>
        <div class="d-flex gap-2">
            <a href="{{ route('laporan.daftar') }}" class="btn btn-sm btn-outline-secondary" target="_blank">
                <i class="bi bi-printer me-1"></i>Cetak
            </a>
            <a href="{{ route('peserta.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Daftar Baru
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau nomor..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="jurusan" class="form-select">
                    <option value="">Semua Jurusan</option>
                    @foreach($jurusans as $j)
                    <option value="{{ $j }}" {{ request('jurusan')==$j ? 'selected' : '' }}>{{ $j }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"><button type="submit" class="btn btn-primary w-100">Filter</button></div>
            <div class="col-md-1"><a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary w-100">Reset</a></div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>#</th><th>No. Daftar</th><th>Nama Peserta</th><th>Jurusan</th><th>JK</th><th>Kecamatan</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                @forelse($pendaftarans as $i => $p)
                <tr>
                    <td>{{ $pendaftarans->firstItem() + $i }}</td>
                    <td><code>{{ $p->nomor_pendaftaran }}</code></td>
                    <td>{{ $p->nama_peserta }}</td>
                    <td><span class="badge bg-light text-dark">{{ $p->jurusan }}</span></td>
                    <td>{{ $p->jenis_kelamin === 'Laki-laki' ? 'L' : 'P' }}</td>
                    <td>{{ $p->kecamatan->nama_kecamatan }}</td>
                    <td>
                        @php $badge = ['pending'=>'warning','diterima'=>'success','ditolak'=>'danger'][$p->status] @endphp
                        <span class="badge bg-{{ $badge }}">{{ ucfirst($p->status) }}</span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('peserta.show',$p) }}" class="btn btn-sm btn-outline-primary" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('peserta.edit',$p) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('peserta.destroy',$p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                            <a href="{{ route('laporan.bukti',$p) }}" class="btn btn-sm btn-outline-secondary" title="Cetak Bukti" target="_blank"><i class="bi bi-printer"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-5"><i class="bi bi-inbox" style="font-size:2rem"></i><br>Tidak ada data peserta</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <small class="text-muted">Menampilkan {{ $pendaftarans->count() }} dari {{ $pendaftarans->total() }} data</small>
            {{ $pendaftarans->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
