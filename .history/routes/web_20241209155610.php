<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});

// Rute Registrasi
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);


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

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Route untuk search
Route::get('/search', [SuratMasukController::class, 'search'])->name('search');

// Route untuk surat keluar
Route::resource('suratkeluar', SuratKeluarController::class);

// Route untuk menghapus surat keluar
Route::delete('/suratkeluar/{id}', [SuratKeluarController::class, 'destroy'])->name('suratkeluar.destroy');

// Route pencarian surat keluar
Route::get('/search-suratkeluar', [SuratKeluarController::class, 'search'])->name('search.suratkeluar');

// Route untuk laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

// Routes untuk laporan surat keluar
Route::get('/laporan-surat-keluar', [LaporanController::class, 'laporanSuratKeluar'])->name('laporan.suratkeluar');

// Logout boskuu
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Arahkan ke rute login
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('suratmasuk', SuratMasukController::class);
    Route::resource('suratkeluar', SuratKeluarController::class);
});
