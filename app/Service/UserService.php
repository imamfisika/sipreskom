<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Auth;



class UserService {

    public function Register($request) {

        $validated = $request->validate([
            'nama' => 'required',
            'nim' => 'required|max:10|unique:mahasiswas,nim',
            'email' => 'required|email|unique:mahasiswas,email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->nama = $validated['nama'];
        $user->nim = $validated['nim'];
        $user->email = $validated['email'];
        $user->role = 'mahasiswa';
        $user->password = bcrypt($validated['password']);
        $user->save();

        return $user;
    }

    public function Login($request) {

        $credentials = $request->only('nim', 'password');

        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        return null;
    }

    public function getMahasiswa($request){

        $validated = $request->validate([
            'id' => 'required',
        ]);

        $mahasiswa = Mahasiswa::find($validated['id']);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404);
        }

        return $mahasiswa;
    }

    public function deleteMahasiswa($request) {

        $validated = $request->validate([
            'id' => 'required|exists:mahasiswas,id',
        ]);

        $mahasiswa = Mahasiswa::find($validated['id']);
        if ($mahasiswa) {
            $mahasiswa->delete();
            return response()->json(['message' => 'Mahasiswa deleted successfully'], 200);
        }

        return response()->json(['message' => 'Mahasiswa not found'], 404);
    }

    public function updateMahasiswa($request) {

        $validated = $request->validate([
            'id' => 'required|exists:mahasiswas,id',
            'nama' => 'required',
            'nim' => 'required|max:10|unique:mahasiswas,nim,' . $request->id,
            'email' => 'required|email|unique:mahasiswas,email,' . $request->id,
            'foto' => 'nullable|image|max:2048',
        ]);

        $mahasiswa = Mahasiswa::find($validated['id']);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404);
        }

        $mahasiswa->nama = $validated['nama'];
        $mahasiswa->nim = $validated['nim'];
        $mahasiswa->email = $validated['email'];

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $mahasiswa->foto = $fotoPath;
        }

        $mahasiswa->save();

        return response()->json(['message' => 'Mahasiswa updated successfully', 'data' => $mahasiswa], 200);
    }
}
