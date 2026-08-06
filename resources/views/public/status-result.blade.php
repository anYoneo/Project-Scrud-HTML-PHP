@extends('layouts.app')
@section('title', 'Hasil Cek Status')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mt-5">
            <div class="card-body p-4">
                <h4 class="mb-4 text-center">Detail Status Pendaftaran</h4>
                
                <table class="table table-borderless">
                    <tr>
                        <td width="40%" class="text-muted">Nomor Pendaftaran</td>
                        <td width="5%">:</td>
                        <td class="fw-bold">{{ $pendaftaran->nomor_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nama Peserta</td>
                        <td>:</td>
                        <td>{{ $pendaftaran->nama_peserta }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jurusan Pilihan</td>
                        <td>:</td>
                        <td>{{ $pendaftaran->jurusan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status Saat Ini</td>
                        <td>:</td>
                        <td>
                            @if($pendaftaran->status == 'pending')
                                <span class="badge badge-pending px-3 py-2"><i class="bi bi-hourglass-split"></i> Pending</span>
                            @elseif($pendaftaran->status == 'verified')
                                <span class="badge badge-verified px-3 py-2"><i class="bi bi-check2-circle"></i> Terverifikasi</span>
                            @elseif($pendaftaran->status == 'accepted' || $pendaftaran->status == 'diterima')
                                <span class="badge badge-accepted px-3 py-2"><i class="bi bi-trophy"></i> Diterima</span>
                            @elseif($pendaftaran->status == 'rejected' || $pendaftaran->status == 'ditolak')
                                <span class="badge badge-rejected px-3 py-2"><i class="bi bi-x-circle"></i> Ditolak</span>
                            @endif
                        </td>
                    </tr>
                    @if($pendaftaran->catatan_admin)
                    <tr>
                        <td class="text-muted">Catatan dari Admin</td>
                        <td>:</td>
                        <td class="text-danger fst-italic">{{ $pendaftaran->catatan_admin }}</td>
                    </tr>
                    @endif
                </table>

                <div class="text-center mt-4 pt-3 border-top">
                    <a href="{{ route('registration.check') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
