@extends('layouts.app')
@section('title', 'Cek Status Pendaftaran')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card mt-5">
            <div class="card-body p-4 text-center">
                <i class="bi bi-search display-4 text-primary mb-3"></i>
                <h3 class="mb-4">Cek Status Pendaftaran</h3>
                <form action="{{ route('registration.status', 'check') }}" method="GET" onsubmit="event.preventDefault(); window.location.href='{{ url('cek-status') }}/' + document.getElementById('nomor_pendaftaran').value;">
                    <div class="mb-3 text-start">
                        <label for="nomor_pendaftaran" class="form-label">Nomor Pendaftaran</label>
                        <input type="text" class="form-control" id="nomor_pendaftaran" placeholder="Contoh: PSB-20230801-001" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cek Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection