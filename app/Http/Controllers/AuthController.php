<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        return view('dashboard', [
            'user' => Auth::user()
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|numeric|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([

            'nim' => 'required|string',
            'password' => 'required|string',

        ]);


        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }



        return back()->withErrors([

            'nim' => 'Nomor induk yang dimasukkan tidak terdata dalam sistem',

        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }
}
