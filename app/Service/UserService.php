<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Auth;



class UserService {

    public function Register($request) {

        $validated = $request->validate([
            'nama' => 'required',
            'nim' => 'required|max:10|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->nama = $validated['nama'];
        $user->nim = $validated['nim'];
        $user->email = $validated['email'];
        $user->role = 'mahasiswa';
        $user->password = bcrypt($validated['password']);
        $user->save();

        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function Login($request) {

        $credentials = $request->only('nim', 'password');

        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        return null;
    }

    public function getUser($request) {

        $validated = $request->validate([
            'id' => 'required',
        ]);

        $user = User::find($validated['id']);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $user;
    }

    public function deleteUser($request) {

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

    public function updateUser($request) {

        $validated = $request->validate([
            'id' => 'required|exists:users,id',
            'nama' => 'required',
            'nim' => 'required|max:10|unique:users,nim,' . $request->id,
            'email' => 'required|email|unique:users,email,' . $request->id,
            'foto' => 'nullable|image|max:2048',
        ]);

        $user = User::find($validated['id']);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->nama = $validated['nama'];
        $user->nim = $validated['nim'];
        $user->email = $validated['email'];

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $user->foto = $fotoPath;
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully', 'data' => $user], 200);
    }
}
