<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;

// Menu route
Route::get('/menu', [AuthController::class, 'showMenu'])->name('menu');

// Default home route
Route::get('/', function () {
    return view('welcome');
});

// Surat Routes
Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Surat Masuk Routes (this includes edit, update, and other actions)
Route::resource('surat_masuk', SuratMasukController::class)->middleware('auth');
Route::get('/search', [SuratMasukController::class, 'search'])->name('search');

// Surat Keluar Routes
Route::resource('suratkeluar', SuratKeluarController::class)->middleware('auth');
Route::delete('/suratkeluar/{id}', [SuratKeluarController::class, 'destroy'])->name('suratkeluar.destroy');
Route::get('/search-suratkeluar', [SuratKeluarController::class, 'search'])->name('search.suratkeluar');

// Laporan Routes
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan-surat-keluar', [LaporanController::class, 'laporanSuratKeluar'])->name('laporan.suratkeluar');
