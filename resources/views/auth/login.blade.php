<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PSB Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: #fff; border-radius: 20px; padding: 2.5rem; box-shadow: 0 20px 60px rgba(0,0,0,.2); width: 100%; max-width: 420px; }
        .login-logo { width: 70px; height: 70px; background: linear-gradient(135deg, #0d6efd, #0056b3); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; }
        .login-logo i { font-size: 2rem; color: white; }
        .form-control { border-radius: 10px; padding: .75rem 1rem; border: 1.5px solid #e9ecef; }
        .form-control:focus { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13,110,253,.15); }
        .btn-login { border-radius: 10px; padding: .8rem; font-weight: 600; font-size: 1rem; }
        .input-group-text { background: #f8f9fa; border: 1.5px solid #e9ecef; color: #6c757d; }
    </style>
</head>
<body>
<div class="login-card">
    <div class="login-logo"><i class="bi bi-mortarboard-fill"></i></div>
    <h4 class="text-center fw-bold mb-1">PSB Online</h4>
    <p class="text-center text-muted small mb-4">Sistem Penerimaan Siswa Baru</p>
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-500">Username</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                       placeholder="Masukkan username" value="{{ old('username') }}" autofocus>
            </div>
            @error('username')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="form-label fw-500">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Masukkan password">
            </div>
            @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary w-100 btn-login">
            <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
