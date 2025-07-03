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
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'has_role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'viewMahasiswa'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/prestasi-akademik', [MahasiswaController::class, 'viewPrestasiAkademik'])->name('mahasiswa.prestasi-akademik.index');

    Route::get('/mahasiswa/rekomendasi', [MahasiswaController::class, 'viewRekomendasi'])->name('mahasiswa.rekomendasi');

    Route::get('/mahasiswa/profile', [MahasiswaController::class, 'viewProfile'])->name('mahasiswa.profile');
    Route::post('/mahasiswa/profile/upload-foto', [MahasiswaController::class, 'updatePhoto'])->name('mahasiswa.profile.upload');
});

Route::middleware(['auth', 'has_role:dosenpa'])->group(function () {
    Route::get('/dosenpa/dashboard', [DosenpaController::class, 'viewDosenpa'])->name('dosenpa.dashboard');

    Route::get('/dosenpa/rekomendasi', [DosenpaController::class, 'viewRekomendasi'])->name('dosenpa.rekomendasi.view');
    Route::get('/dosenpa/rekomendasi/tambah', [DosenpaController::class, 'formTambahRekomendasi'])->name('dosenpa.rekomendasi.tambah');
    Route::get('/dosenpa/rekomendasi/matkul/{nim}', [DosenpaController::class, 'getMatkulBelumDiambilByNim'])->name('dosenpa.rekomendasi.matkul');
    Route::post('/dosenpa/rekomendasi/simpan', [DosenpaController::class, 'simpanRekomendasi'])->name('dosenpa.rekomendasi.simpan');

    Route::get('/dosenpa/prestasi-akademik', [DosenpaController::class, 'viewPrestasiAkademik'])->name('dosenpa.prestasi-akademik.index');
    Route::get('/dosenpa/prestasi-akademik/{nim}', [DosenpaController::class, 'viewPrestasiAkademikMahasiswa'])->name('dosenpa.prestasi-akademik.mahasiswa');
    Route::get('/dosenpa/laporan-akademik', [DosenpaController::class, 'viewLaporanAkademik'])->name('dosenpa.prestasi-akademik.laporan');
    Route::get('/dosenpa/laporan-akademik/cetak', [DosenpaController::class, 'cetakLaporanAkademik'])->name('dosenpa.prestasi-akademik.cetakLaporan');
    Route::get('/dosenpa/laporan-akademik/unduh', [DosenpaController::class, 'unduhLaporan'])->name('dosenpa.prestasi-akademik.unduhLaporan');

    Route::get('/dosenpa/profile', [DosenpaController::class, 'viewProfile'])->name('dosenpa.profile');
    Route::post('/dosenpa/profile/upload-foto', [DosenpaController::class, 'updatePhoto'])->name('dosenpa.profile.upload');
});


Route::middleware(['auth', 'has_role:adminprodi'])->group(function () {
    Route::get('/adminprodi/dashboard', [AdminprodiController::class, 'viewAdminprodi'])->name('adminprodi.dashboard');

    Route::get('/adminprodi/kelola-pengguna', [AdminprodiController::class, 'viewKelolaPengguna'])->name('adminprodi.kelola-pengguna.view');
    Route::put('/{nim}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('/{nim}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/{id}/delete', [UserController::class, 'delete'])->name('admin.users.delete');

    Route::get('/adminprodi/kelola-prestasi-akademik', [AdminprodiController::class, 'viewKelolaPrestasi'])->name('adminprodi.prestasi-akademik.view');
    Route::delete('/adminprodi/prestasi-akademik/delete-prestasi/{id}', [AdminprodiController::class, 'deletePrestasi'])->name('adminprodi.prestasi-akademik.deletePrestasi');
    Route::delete('/adminprodi/prestasi-akademik/delete-matkul/{id}', [AdminprodiController::class, 'deleteMatkul'])->name('adminprodi.prestasi-akademik.deleteMatkul');
    Route::delete('/adminprodi/daftar-nilai/{id}', [AdminprodiController::class, 'deleteDaftarNilai'])->name('adminprodi.daftar-nilai.delete');

    Route::get('/adminprodi/prestasi-akademik/tambah', [AdminprodiController::class, 'create'])->name('adminprodi.prestasi-akademik.create');

    Route::prefix('adminprodi')->group(function () {
        Route::post('/akademik/store', [AdminprodiController::class, 'storeAkademik'])->name('adminprodi.akademik.store');
        Route::post('/matkul/store', [AdminprodiController::class, 'storeMatkul'])->name('adminprodi.matkul.store');
        Route::post('/nilai/store', [AdminprodiController::class, 'storeNilai'])->name('adminprodi.nilai.store');
        Route::post('/nilai/import', [AdminprodiController::class, 'importExcel'])->name('adminprodi.nilai.import');
        Route::post('/matkul/import', [AdminprodiController::class, 'importMatkulExcel'])->name('adminprodi.matkul.importExcel');
        Route::post('/akademik/import', [AdminprodiController::class, 'importAkademikExcel'])->name('adminprodi.akademik.importExcel');
    });
});
