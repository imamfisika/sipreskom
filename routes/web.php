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
    Route::get('/dashboard/mahasiswa', [MahasiswaController::class, 'viewMahasiswa'])->name('mahasiswa.dashboard');
});

Route::middleware(['auth', 'has_role:dosenpa'])->group(function () {
    Route::get('/dashboard/dosen', [DosenpaController::class, 'viewDosenpa'])->name('dosenpa.dashboard');
});

Route::middleware(['auth', 'has_role:adminprodi'])->group(function () {
    Route::get('/dashboard/admin', [AdminprodiController::class, 'viewAdminprodi'])->name('adminprodi.dashboard');
});


Route::middleware(['auth', 'has_role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/prestasi-akademik', [MahasiswaController::class, 'viewPrestasiAkademik'])->name('mahasiswa.prestasi-akademik.index');
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