<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    public function login($request)
    {
        $validated = $request->validate([
            'nim' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validated)) {
            return $this->redirectToDashboard(Auth::user());
        }

        return back()->withErrors(['error' => 'Login akun gagal, NIM atau password salah.']);
    }

    private function redirectToDashboard(User $user)
    {
        $routes = [
            'dosenpa'     => 'dosenpa.dashboard',
            'mahasiswa'   => 'mahasiswa.dashboard',
            'adminprodi'  => 'adminprodi.dashboard',
        ];

        if (isset($routes[$user->role])) {
            return redirect()->route($routes[$user->role])
                ->with('success', 'Login berhasil sebagai ' . ucfirst($user->role) . '.');
        }

        Auth::logout();
        return back()->withErrors(['error' => 'Role tidak valid.']);
    }


    // private function handleRoleRedirect($user)
    // {
    //     $routes = [
    //         'dosenpa' => 'dosenpa.dashboard',
    //         'mahasiswa' => 'mahasiswa.dashboard',
    //         'adminprodi' => 'adminprodi.dashboard',
    //     ];

    //     if (isset($routes[$user->role])) {
    //         return redirect()->route($routes[$user->role])
    //             ->with('success', 'Login berhasil sebagai ' . ucfirst($user->role) . '.');
    //     }

    //     Auth::logout();
    //     return back()->withErrors(['error' => 'Role tidak valid.']);
    // }

    public function getUser($request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:users,id',
        ]);

        $user = User::find($validated['id']);

        return response()->json($user);
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
