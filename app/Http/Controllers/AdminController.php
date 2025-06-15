<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;


class AdminController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'mahasiswa')
            ->select('role', 'name', 'nim')
            ->orderBy('nim', 'asc')
            ->get()
            ->map(function ($user) {
            $user->angkatan = substr($user->nim, 5, 2);
            return $user;
            });

        return view('listMhs', compact('mahasiswa'));
    }
    public function destroy($nim): RedirectResponse
    {
        $mahasiswa = User::where('role', 'mahasiswa')->where('nim', $nim)->firstOrFail();
        $mahasiswa->delete();

        return redirect()->route('list-mhs')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
