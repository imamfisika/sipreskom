<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenpaController extends Controller
{
    public function viewDosenpa()
    {
        return view('dosenpa.dashboard');
    }
    public function viewRekomendasi()
    {
        return view('dosenpa.rekomendasi.view');
    }
    public function tambahRekomendasi()
    {
        return view('dosenpa.rekomendasi.tambah');
    }
    public function viewPrestasiAkademik()
    {
        return view('dosenpa.prestasi-akademik.index');
    }
    public function viewPrestasiAkademikMahasiswa()
    {
        return view('dosenpa.prestasi-akademik.mahasiswa');
    }
    public function viewLaporanAkademik()
    {
        return view('dosenpa.prestasi-akademik.laporan');
    }
    public function viewProfile()
    {
        return view('dosenpa.profile');
    }
}