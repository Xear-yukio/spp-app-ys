<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SPPController;
use App\Http\Controllers\PembayaranController;

// 1. Auth (bebas akses - tanpa middleware)
Route::get('/', fn() => redirect('/login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']); // <-- PASTIKAN DI SINI (luar grup)

// 2. Siswa Only (musti login + level siswa)
Route::middleware(['auth', 'siswa.only'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    Route::get('/siswa/histori', [SiswaDashboardController::class, 'histori'])->name('siswa.histori');
});

// 3. Admin & Petugas Only (musti login + level admin/petugas)
Route::middleware(['auth', 'admin.petugas'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SPPController::class);
});