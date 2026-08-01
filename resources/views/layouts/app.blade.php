<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PSB Online') - PSB Online SMK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #fff; box-shadow: 2px 0 10px rgba(0,0,0,.08); width: 260px; position: fixed; top: 0; left: 0; z-index: 100; }
        .sidebar-brand { padding: 1.5rem; border-bottom: 1px solid #e9ecef; }
        .sidebar-brand h5 { color: #0d6efd; font-weight: 700; margin: 0; }
        .sidebar-brand small { color: #6c757d; font-size: .75rem; }
        .sidebar .nav-link { color: #495057; padding: .65rem 1.5rem; border-radius: 8px; margin: 2px 12px; font-weight: 500; font-size: .9rem; transition: all .2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #e8f0fe; color: #0d6efd; }
        .sidebar .nav-link i { width: 20px; }
        .main-content { margin-left: 260px; }
        .topbar { background: #fff; padding: 1rem 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,.06); position: sticky; top: 0; z-index: 99; display: flex; justify-content: space-between; align-items: center; }
        .topbar .page-title { font-weight: 600; color: #212529; margin: 0; font-size: 1.1rem; }
        .content-area { padding: 1.5rem; }
        .card { border: none; box-shadow: 0 2px 12px rgba(0,0,0,.06); border-radius: 12px; }
        .card-header { background: transparent; border-bottom: 1px solid #e9ecef; font-weight: 600; padding: 1rem 1.25rem; }
        .stat-card { border-radius: 12px; color: white; padding: 1.5rem; }
        .stat-card .stat-number { font-size: 2rem; font-weight: 700; }
        .stat-card .stat-label { opacity: .85; font-size: .9rem; }
        .btn { border-radius: 8px; font-weight: 500; }
        .table thead th { background: #f8f9fa; font-weight: 600; font-size: .85rem; text-transform: uppercase; letter-spacing: .05em; color: #6c757d; }
        .badge { border-radius: 6px; font-weight: 500; }
        @media (max-width: 768px) { .sidebar { transform: translateX(-100%); } .main-content { margin-left: 0; } }
    </style>
    @stack('styles')
</head>
<body>
<div class="sidebar">
    <div class="sidebar-brand">
        <h5><i class="bi bi-mortarboard-fill me-2"></i>PSB Online</h5>
        <small>Penerimaan Siswa Baru</small>
    </div>
    <div class="pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('peserta.index') }}" class="nav-link {{ request()->routeIs('peserta.*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i>Data Peserta
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('peserta.create') }}" class="nav-link">
                    <i class="bi bi-person-plus me-2"></i>Daftar Baru
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('laporan.daftar') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <i class="bi bi-printer me-2"></i>Laporan
                </a>
            </li>
            <li class="nav-item mt-3">
                <form action="{{ route('logout') }}" method="POST" class="px-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
<div class="main-content">
    <div class="topbar">
        <h6 class="page-title">@yield('page-title', 'Dashboard')</h6>
        <span class="text-muted small"><i class="bi bi-person-circle me-1"></i>{{ session('admin_name') }}</span>
    </div>
    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
