<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



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

    public function deleteUser($request)
    {

        $validated = $request->validate([
            'id' => 'required|exists:Users,id',
        ]);

        $user = User::find($validated['id']);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    public function updateUser($request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'nim' => 'required|max:10|unique:users,nim,' . $request->id,
            'email' => 'required|email|unique:users,email,' . $request->id,
            'foto' => 'nullable|image|max:2048',
        ]);

        $user = User::find($validated['id']);

        $user->nama = $validated['nama'];
        $user->nim = $validated['nim'];
        $user->email = $validated['email'];

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $user->foto = $fotoPath;
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully', 'data' => $user], 200);
    }
}
