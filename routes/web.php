<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;

Route::get('/', function () {
    return view('welcome');
});

// Rute Registrasi
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Rute Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Rute Surat Masuk
Route::resource('surat_masuk', SuratMasukController::class)->middleware('auth');
Route::get('/suratmasuk/create', [SuratMasukController::class, 'create'])->name('suratmasuk.create');

// Rute Resource Surat Masuk
Route::resource('suratmasuk', SuratMasukController::class)->middleware('auth');

// Jika ingin mendefinisikan rute secara manual
Route::get('/suratmasuk/create', [SuratMasukController::class, 'create'])->name('suratmasuk.create');

// Route untuk menampilkan form edit
Route::get('/surat_masuk/{id}/edit', [SuratMasukController::class, 'edit'])->name('surat_masuk.edit');

// Route untuk menyimpan perubahan setelah edit
Route::put('/surat_masuk/{id}', [SuratMasukController::class, 'update'])->name('surat_masuk.update');
