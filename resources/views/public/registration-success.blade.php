@extends('layouts.app')
@section('title', 'Pendaftaran Berhasil')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <div class="card mt-5 border-success border-2">
            <div class="card-body p-5">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                <h2 class="mt-3 mb-2">Pendaftaran Berhasil!</h2>
                <p class="text-muted">Terima kasih, data pendaftaran Anda telah kami terima.</p>
                
                <div class="bg-light p-3 rounded mb-4 mt-4">
                    <p class="mb-1">Nomor Pendaftaran Anda:</p>
                    <h3 class="text-primary fw-bold mb-0">{{ $pendaftaran->nomor_pendaftaran ?? 'PSB-'.date('Ymd').'-001' }}</h3>
                </div>

                <div class="alert alert-warning text-start">
                    <i class="bi bi-exclamation-triangle"></i> <strong>Penting!</strong> Harap simpan nomor pendaftaran ini untuk mengecek status seleksi Anda.
                </div>

                <div class="d-flex justify-content-center gap-2 mt-4">
                    <button onclick="window.print()" class="btn btn-secondary">
                        <i class="bi bi-printer"></i> Cetak Bukti
                    </button>
                    <a href="{{ route('registration.check') }}" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cek Status
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection