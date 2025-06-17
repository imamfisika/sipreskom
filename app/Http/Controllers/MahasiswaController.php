<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller {
    public function register(Request $request) {
        $mahasiswaService = app('App\Service\MahasiswaService');
        return $mahasiswaService->Register($request);
    }

    public function login(Request $request) {
        $mahasiswaService = app('App\Service\MahasiswaService');
        return $mahasiswaService->Login($request);
    }

    public function getMahasiswa(Request $request) {
        $mahasiswaService = app('App\Service\MahasiswaService');
        return $mahasiswaService->getMahasiswa($request);
    }

    public function deleteMahasiswa(Request $request) {
        $mahasiswaService = app('App\Service\MahasiswaService');
        return $mahasiswaService->deleteMahasiswa($request);
    }

    public function updateMahasiswa(Request $request) {
        $mahasiswaService = app('App\Service\MahasiswaService');
        return $mahasiswaService->updateMahasiswa($request);
    }
}
