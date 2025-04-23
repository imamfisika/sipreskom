<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/login', view: 'login')-> name('login');
Route::view('/register', view: 'register')-> name('register');


