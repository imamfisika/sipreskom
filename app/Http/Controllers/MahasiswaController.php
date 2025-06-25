<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function viewMahasiswa()
    {
        return view('mahasiswa.dashboard');
    }
    public function viewPrestasiAkademik()
    {
        return view('mahasiswa.prestasi-akademik.index');
    }
}
