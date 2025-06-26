<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminprodiController extends Controller
{
    public function viewAdminprodi()
    {
        return view('adminprodi.dashboard');
    }
    public function viewPrestasiAkademik()
    {
        return view('adminprodi.prestasi-akademik.index');
    }
    public function viewKelolaPengguna(Request $request)
    {
        $role = $request->query('role');
        return view('adminprodi.kelola-pengguna.view', compact('role'));
    }
}