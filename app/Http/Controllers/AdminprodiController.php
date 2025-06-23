<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminprodiController extends Controller
{
    public function viewAdminprodi()
    {
        return view('admin.dashboard');
    }
}