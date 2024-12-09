<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratController;

// Route to fetch usernames for the dropdown
Route::get('/users/usernames', [UserController::class, 'showUsernames'])->name('users.usernames');

// Route for displaying the list of all users (optional)
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('suratmasuk', SuratMasukController::class)->middleware('auth');


// Dashboard Routes (protected by auth middleware)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Surat Masuk Routes (protected by auth middleware)
Route::resource('surat_masuk', SuratMasukController::class)->middleware('auth');
Route::get('/suratmasuk/create', [SuratMasukController::class, 'create'])->name('suratmasuk.create');
Route::get('/surat_masuk/{id}/edit', [SuratMasukController::class, 'edit'])->name('surat_masuk.edit');
Route::put('/surat_masuk/{id}', [SuratMasukController::class, 'update'])->name('surat_masuk.update');
Route::get('/search', [SuratMasukController::class, 'search'])->name('search');

// Surat Keluar Routes
Route::resource('suratkeluar', SuratKeluarController::class)->middleware('auth');
Route::delete('/suratkeluar/{id}', [SuratKeluarController::class, 'destroy'])->name('suratkeluar.destroy');
Route::get('/search-suratkeluar', [SuratKeluarController::class, 'search'])->name('search.suratkeluar');

// Laporan Routes
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan-surat-keluar', [LaporanController::class, 'laporanSuratKeluar'])->name('laporan.suratkeluar');

