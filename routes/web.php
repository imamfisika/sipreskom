<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanAkademikController;
use App\Http\Controllers\PrestasiAkademikController;
use App\Http\Controllers\PrestasiAkademikDsnController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RekomendasiController;


// Route::get('/', fn() => view('auth.login'));

// Route::get('/login', [AuthController::class, 'showLogin']);
// Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::get('/register', [AuthController::class, 'showRegister']);
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function() {
    return view('auth.login');
});

Route::get('/register', function() {
    return view('auth.register');
});



Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/prestasi-akademik', action: [PrestasiAkademikController::class, 'index'])->name('prestasi-akademik');
    Route::get('/prestasi-akademik-mahasiswa/{nim}', [PrestasiAkademikDsnController::class, 'index'])->name('prestasi-akademik-mahasiswa');

    Route::get('/laporan-akademik', [LaporanAkademikController::class, 'index'])->name('laporan-akademik');
    Route::get('/laporan-akademik/unduh', [LaporanAkademikController::class, 'unduh'])->name('laporan.unduh');
    Route::get('/laporan-akademik/cetak', [LaporanAkademikController::class, 'cetakPDF'])->name('laporan.cetak');

    Route::get('/tambah-rekomendasi', [RekomendasiController::class, 'create'])->name('rekomendasi.create');
    Route::post('/rekomendasi', [RekomendasiController::class, 'store'])->name('rekomendasi.store');
    Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi');


    Route::get('/ipk/{nim}', [PrestasiAkademikDsnController::class, 'showMahasiswa']);
    Route::get('/list-mhs', [AdminController::class, 'index'])->name('list-mhs');
    Route::delete('/list-mhs/{nim}', [AdminController::class, 'destroy'])->name('hapus-mahasiswa');


});
