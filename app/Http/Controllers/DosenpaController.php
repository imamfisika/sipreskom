<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenpaController extends Controller
{
    public function viewDosenpa()
    {
        return view('dosen.dashboard');
    }
}