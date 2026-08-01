<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PesertaController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;

// --- Public ---
Route::get('/', fn () => redirect()->route('login'))->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// --- Protected ---
Route::middleware([AuthCheck::class])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('peserta', PesertaController::class);
    Route::get('/peserta-autocomplete', [PesertaController::class, 'autocompleteKecamatan'])
         ->name('peserta.autocomplete');
    Route::patch('/peserta/{peserta}/status', [PesertaController::class, 'updateStatus'])
         ->name('peserta.status');

    Route::get('/laporan/bukti/{peserta}', [LaporanController::class, 'cetakBukti'])
         ->name('laporan.bukti');
    Route::get('/laporan/daftar', [LaporanController::class, 'cetakDaftar'])
         ->name('laporan.daftar');
});
