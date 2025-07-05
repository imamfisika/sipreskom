<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;



class UserService
{

    public function register($request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:18|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $nimLength = strlen($validated['nim']);
        if ($nimLength === 18) {
            $role = 'dosenpa';
        } elseif ($nimLength === 5) {
            $role = 'adminprodi';
        } else {
            $role = 'mahasiswa';
        }

        $user = new User([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
            'role' => $role,
            'password' => bcrypt($validated['password']),
        ]);


        return $user->save();
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nim', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role) {
                case 'adminprodi':
                    return redirect()->route('adminprodi.dashboard');
                case 'dosenpa':
                    return redirect()->route('dosenpa.dashboard');
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['login' => 'Role tidak dikenali.']);
            }
        }

        return back()->withErrors(['login' => 'Login akun gagal, NIM atau password salah.']);
    }

    private function redirectToDashboard($user)
    {
        switch ($user->role) {
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard')->with('success', 'Login berhasil.');
            case 'dosenpa':
                return redirect()->route('dosenpa.dashboard')->with('success', 'Login berhasil.');
            case 'adminprodi':
                return redirect()->route('adminprodi.dashboard')->with('success', 'Login berhasil.');
            default:
                Auth::logout();
                return back()->withErrors(['error' => 'Role tidak dikenali.']);
        }
    }

    public function getUser($request)
    {

        $validated = $request->validate([
            'id' => 'required',
        ]);

        $user = User::find($validated['id']);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $user;
    }

    public function findByNim($nim)
    {
        return User::where('nim', $nim)->firstOrFail();
    }

    public function updateByNim(Request $request, $nim)
    {
        $user = User::where('nim', $nim)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nim'   => 'required|string|max:18|unique:users,nim,' . $user->id,
        ]);
        $user->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'nim' => $request->input('nim'),
        ]);
    }

    public function deleteUserById($id)
    {
        User::findOrFail($id)->delete();
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login')->with('success', 'Logout berhasil karena tidak ada aktivitas dalam beberapa waktu.');
    }

    public function authorizeAdmin()
    {
        if (Auth::user()->role !== 'adminprodi') {
            abort(403, 'Anda tidak memiliki izin untuk mengubah data pengguna.');
        }
    }

    public function updateProfilePhoto($id, $photo)
    {
        $user = User::findOrFail($id);

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $path = $photo->store('images', 'public');
        $user->update(['foto' => $path]);
    }

    public function updatePassword($userId, $newPassword)
    {
        $user = User::findOrFail($userId);
        $user->password = Hash::make($newPassword);
        $user->save();
    }
}
