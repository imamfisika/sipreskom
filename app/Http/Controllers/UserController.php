<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Service\UserService;

class UserController extends Controller
{

    public function viewRegister()
    {
        return view('auth.register');
    }

    public function viewLogin()
    {
        return view('auth.login');
    }


    public function register(Request $request)
    {
        $userService = new UserService();
        $success = $userService->register($request);

        return $success
            ? redirect()->route('login')->with('success', 'Akun berhasil didaftarkan. Silakan login.')
            : back()->withErrors(['error' => 'Pendaftaran gagal. Silakan coba lagi.']);
    }
    public function login(Request $request)
{
    $userService = new UserService();
    return $userService->login($request);
}

    public function getById(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Akun tidak ditemukan.'], 404);
        }

        return response()->json($user);
    }

    public function getAll(Request $request)
    {
        $users = User::all();
        return response()->json($users);
    }

    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Akun tidak ditemukan.'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Akun berhasil dihapus.']);
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $userService = new UserService();
        return $userService->updateUser($request);
    }
}
