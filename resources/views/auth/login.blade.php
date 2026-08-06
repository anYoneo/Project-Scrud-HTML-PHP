@extends('layouts.app')
@section('title', 'Login Admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card mt-5">
            <div class="card-body p-4">
                <h3 class="text-center mb-4"><i class="bi bi-shield-lock"></i> Login Admin</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required autofocus>
                        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
