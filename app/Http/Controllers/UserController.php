<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Service\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdatePasswordRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
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

    public function delete($id)
    {
        $this->userService->deleteUserById($id);
        return redirect()->back()->with('success', 'Akun pengguna berhasil dihapus.');
    }

    public function update(Request $request, $nim)
    {
        $this->userService->updateByNim($request, $nim);

        return redirect()->route('adminprodi.kelola-pengguna.view', [
            'role' => $request->input('role')
        ])->with('success', 'Data berhasil diperbarui');
    }

    public function edit($nim)
    {
        $editUser = $this->userService->findByNim($nim);
        return view('adminprodi.kelola-pengguna.edit', compact('editUser'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $this->userService->updatePassword(Auth::id(), $request->new_password);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

}
