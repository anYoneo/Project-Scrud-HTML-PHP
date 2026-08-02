<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\PublicRegistrationController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::get('/daftar', [PublicRegistrationController::class, 'create'])->name('registration.create');
Route::post('/daftar', [PublicRegistrationController::class, 'store'])->name('registration.store');
Route::get('/daftar/sukses/{nomorPendaftaran}', [PublicRegistrationController::class, 'success'])->name('registration.success');
Route::get('/cek-status', [PublicRegistrationController::class, 'checkStatus'])->name('registration.check');
Route::get('/cek-status/{nomorPendaftaran}', [PublicRegistrationController::class, 'showStatus'])->name('registration.status');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::patch('/pendaftaran/{pendaftaran}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
    Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
});