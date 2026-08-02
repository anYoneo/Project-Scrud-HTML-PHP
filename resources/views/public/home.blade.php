@extends('layouts.app')
@section('title', 'PSB Online v2 — Penerimaan Siswa Baru')
@section('content')
<div class="text-center py-5">
    <h1 class="display-4 fw-bold text-primary">Penerimaan Siswa Baru</h1>
    <p class="lead text-muted">Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}</p>
    <p class="text-secondary">Sistem pendaftaran online SMK Negeri — cepat, mudah, dan transparan.</p>
    <div class="mt-4">
        <a href="{{ route('registration.create') }}" class="btn btn-primary btn-lg me-2">
            <i class="bi bi-pencil-square"></i> Daftar Sekarang
        </a>
        <a href="{{ route('registration.check') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-search"></i> Cek Status
        </a>
    </div>
</div>

<div class="row g-4 mt-3">
    <div class="col-md-4">
        <div class="card h-100 p-4 text-center">
            <i class="bi bi-file-earmark-text display-4 text-primary"></i>
            <h5 class="mt-3">Syarat Pendaftaran</h5>
            <p class="text-muted">Ijazah/SKHUN, Foto 3x4, KTP Wali, dan Rapor terakhir.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 p-4 text-center">
            <i class="bi bi-calendar-event display-4 text-success"></i>
            <h5 class="mt-3">Jadwal Pendaftaran</h5>
            <p class="text-muted">Pendaftaran dibuka setiap tahun ajaran baru. Cek pengumuman terbaru.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 p-4 text-center">
            <i class="bi bi-building display-4 text-info"></i>
            <h5 class="mt-3">Jurusan Tersedia</h5>
            <p class="text-muted">TKJ, Teknik Otomotif, Teknik Las, Akuntansi, dan Administrasi Perkantoran.</p>
        </div>
    </div>
</div>
@endsection