<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dosenpa()
    {
        return view('dosenpa.dashboard');
    }

    public function mahasiswa()
    {
        return view('mahasiswa.dashboard');
    }

    public function adminprodi()
    {
        return view('adminprodi.dashboard');
    }
}
