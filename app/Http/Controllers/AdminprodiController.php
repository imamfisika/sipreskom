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
}