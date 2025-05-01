<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::view(uri: '/login', view: 'login')-> name('login');
Route::view('/register', view: 'register')-> name('register');
Route::view('/dashboard', view: 'dashboard')-> name('dashboard');
Route::view('/prestasi-akademik', view: 'prestasi')-> name('prestasi');
Route::view('/profil', view: 'profil')-> name('profil');
Route::view('/rekomendasi', view: 'rekomendasi')-> name('rekomendasi');



