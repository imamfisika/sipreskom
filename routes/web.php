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


Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard/mahasiswa', [MahasiswaController::class, 'viewMahasiswa'])->name('mahasiswa.dashboard');
});

Route::middleware(['auth', 'role:dosenpa'])->group(function () {
    Route::get('/dashboard/dosen', [DosenpaController::class, 'viewDosenpa'])->name('dosenpa.dashboard');
});

Route::middleware(['auth', 'role:adminprodi'])->group(function () {
    Route::get('/dashboard/admin', [AdminprodiController::class, 'viewAdminprodi'])->name('adminprodi.dashboard');
});