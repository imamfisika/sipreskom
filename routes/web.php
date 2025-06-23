<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenpaController;
use App\Http\Controllers\AdminprodiController;
use App\Http\Controllers\MahasiswaController;


Route::get('/register', [UserController::class, 'viewRegister']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/', [UserController::class, 'viewLogin'])->name('login');
Route::get('/login', [UserController::class, 'viewLogin']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/get-user/{id}', [UserController::class, 'getById']);
Route::delete('/delete-user/{id}', [UserController::class, 'delete']);
Route::put('/users/{id}', [UserController::class, 'update']);


Route::middleware(['auth', 'role:dosenpa'])->group(function () {
    Route::get('/dashboard/dosen', [DosenpaController::class, 'viewDosenpa'])->name('dosenpa.dashboard');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard/mahasiswa', [MahasiswaController::class, 'viewMahasiswa'])->name('mahasiswa.dashboard');
});

Route::middleware(['auth', 'role:adminprodi'])->group(function () {
    Route::get('/dashboard/admin', [AdminprodiController::class, 'viewAdminprodi'])->name('adminprodi.dashboard');
});


    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    // Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    // Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    // Route::get('/prestasi-akademik', action: [PrestasiAkademikController::class, 'index'])->name('prestasi-akademik');
    // Route::get('/prestasi-akademik-mahasiswa/{nim}', [PrestasiAkademikDsnController::class, 'index'])->name('prestasi-akademik-mahasiswa');

    // Route::get('/laporan-akademik', [LaporanAkademikController::class, 'index'])->name('laporan-akademik');
    // Route::get('/laporan-akademik/unduh', [LaporanAkademikController::class, 'unduh'])->name('laporan.unduh');
    // Route::get('/laporan-akademik/cetak', [LaporanAkademikController::class, 'cetakPDF'])->name('laporan.cetak');

    // Route::get('/tambah-rekomendasi', [RekomendasiController::class, 'create'])->name('rekomendasi.create');
    // Route::post('/rekomendasi', [RekomendasiController::class, 'store'])->name('rekomendasi.store');
    // Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi');


    // Route::get('/ipk/{nim}', [PrestasiAkademikDsnController::class, 'showMahasiswa']);
    // Route::get('/list-mhs', [AdminController::class, 'index'])->name('list-mhs');
    // Route::delete('/list-mhs/{nim}', [AdminController::class, 'destroy'])->name('hapus-mahasiswa');
