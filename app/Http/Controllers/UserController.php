<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use App\Service\UserService;

class UserController extends Controller {

    public function viewRegister() {
        return view('auth.register');
    }

    public function viewLogin() {
        return view('auth.login');
    }


    public function register(Request $request) {
        $validated = $request->validate([
            'nama' => 'required',
            'nim' => 'required|max:18|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $nimLength = strlen($validated['nim']);
        if ($nimLength === 18) {
            $validated['role'] = 'dosenpa';
        } elseif ($nimLength === 5) {
            $validated['role'] = 'adminprodi';
        } else {
            $validated['role'] = 'mahasiswa';
        }

        $userService = new UserService();
        $success = $userService->register($validated);

        if (!$success) {
            return back()->withErrors(['error' => 'Pendaftaran gagal. Silakan coba lagi.']);
        }


        return view('auth.login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    // public function login(Request $request) {
    //     $request->validate([
    //         'nim' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     $credentials = ['nim' => $request->nim, 'password' => $request->password];

    //     if (Auth::attempt($credentials)) {
    //         return redirect()->route('dashboard')->with('success', 'Login akun berhasil.');
    //     }

    //     return back()->withErrors(['nim' => 'NIM tidak terdaftar.']);
    // }

    public function getById(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Akun tidak ditemukan.'], 404);
        }

        return response()->json($user);
    }

    public function getAll(Request $request) {
        $users = User::all();
        return response()->json($users);
    }

    public function delete(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Akun tidak ditemukan.'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Akun berhasil dihapus.']);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Akun tidak ditemukan.'], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'nim' => 'sometimes|string|max:20|unique:users,nim,' . $id,
            'password' => 'sometimes|string|min:8|confirmed',
        ]);

        $user->update($request->only('nama', 'email', 'nim'));

        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return response()->json(['message' => 'Akun berhasil diperbaharui.', 'user' => $user]);
    }
}
