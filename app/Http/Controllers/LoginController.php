<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function form(Request $request)
    {
        $credentials = $request->only('nim', 'password');

        if (Auth::attempt($credentials)) {
            logger('Login berhasil');
            return redirect()->intended('/dashboard');
        }
        logger('Login gagal', $credentials);

        return back()->withErrors([
            'nim' => 'The provided credentials do not match our records.',
        ]);
    }
}
