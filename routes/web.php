<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenpaController;
use App\Http\Controllers\AdminprodiController;


Route::get('/', [UserController::class, 'viewLogin'])->name('login');
Route::get('/login', [UserController::class, 'viewLogin']);
Route::post('/login', [UserController::class, 'login'])->name('login.form');
Route::get('/register', [UserController::class, 'viewRegister'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.store');


Route::middleware(['auth', 'has_role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'viewMahasiswa'])->name('mahasiswa.dashboard');
});

Route::middleware(['auth', 'has_role:dosenpa'])->group(function () {
    Route::get('/dosenpa/dashboard', [DosenpaController::class, 'viewDosenpa'])->name('dosenpa.dashboard');
});

Route::middleware(['auth', 'has_role:adminprodi'])->group(function () {
    Route::get('/adminprodi/dashboard', [AdminprodiController::class, 'viewAdminprodi'])->name('adminprodi.dashboard');
});


Route::middleware(['auth', 'has_role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/prestasi-akademik', [MahasiswaController::class, 'viewPrestasiAkademik'])->name('mahasiswa.prestasi-akademik.index');
});

Route::middleware(['auth', 'has_role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/rekomendasi', [MahasiswaController::class, 'viewRekomendasi'])->name('mahasiswa.rekomendasi');
});

Route::middleware(['auth', 'has_role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/profile', [MahasiswaController::class, 'viewProfile'])->name('mahasiswa.profile');
});

Route::middleware(['auth', 'has_role:dosenpa'])->group(function () {
    Route::get('/dosenpa/rekomendasi', [DosenpaController::class, 'viewRekomendasi'])->name('dosenpa.rekomendasi.view');
});
Route::middleware(['auth', 'has_role:dosenpa'])->group(function () {
    Route::get('/dosenpa/rekomendasi-tambah', [DosenpaController::class, 'tambahRekomendasi'])->name('dosenpa.rekomendasi.tambah');
});
Route::middleware(['auth', 'has_role:dosenpa'])->group(function () {
    Route::get('/dosenpa/prestasi-akademik', [DosenpaController::class, 'viewPrestasiAkademik'])->name('dosenpa.prestasi-akademik.index');
});
Route::middleware(['auth', 'has_role:dosenpa'])->group(function () {
    Route::get('/dosenpa/prestasi-akademik-mahasiswa', [DosenpaController::class, 'viewPrestasiAkademikMahasiswa'])->name('dosenpa.prestasi-akademik.mahasiswa');
});
Route::middleware(['auth', 'has_role:dosenpa'])->group(function () {
    Route::get('/dosenpa/laporan-akademik', [DosenpaController::class, 'viewLaporanAkademik'])->name('dosenpa.prestasi-akademik.laporan');
});
Route::middleware(['auth', 'has_role:dosenpa'])->group(function () {
    Route::get('/dosenpa/profile', [DosenpaController::class, 'viewProfile'])->name('dosenpa.profile');
});

// Route::middleware(['auth', 'has_role:adminprodi'])->group(function () {
//     Route::get('/adminprodi/kelola-prestasi-akademik/{id}', [AdminprodiController::class, 'viewKelolaPrestasi'])->name('adminprodi.prestasi-akademik.view');
// });

Route::middleware(['auth', 'has_role:adminprodi'])->group(function () {
    Route::get('/adminprodi/kelola-pengguna', [AdminprodiController::class, 'viewKelolaPengguna'])->name('adminprodi.kelola-pengguna.view');
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'has_role:adminprodi'])->group(function () {
    Route::put('/{nim}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('/{nim}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/{id}/delete', [UserController::class, 'delete'])->name('admin.users.delete');

    Route::get('/kelola-prestasi-akademik', [AdminprodiController::class, 'viewKelolaPrestasi'])->name('adminprodi.prestasi-akademik.view');
    Route::delete('/kelola-prestasi-akademik/{id}', [AdminprodiController::class, 'deletePrestasi'])
        ->name('adminprodi.prestasi-akademik.delete');
});


// Route::get('/dashboard2', function() {
//     return view('test');
// });

// Route::middleware(['auth', 'has_role:mahasiswa'])->group(function () {
//     // Place routes here that require authentication and a specific role
//     // Example:
//     // Route::get('/dashboard', [SomeController::class, 'dashboard'])->name('dashboard');


//     Route::get('/dashboard1', function() {
//         return view ('test');
//     });


// });