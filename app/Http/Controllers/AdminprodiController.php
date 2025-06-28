<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MahasiswaService;
use App\Service\DosenpaService;
use App\Service\AdminprodiService;



class AdminprodiController extends Controller
{
    protected $adminprodiService;
    protected $mahasiswaService;
    protected $dosenpaService;
    public function __construct(AdminprodiService $adminprodiService, MahasiswaService $mahasiswaService, DosenpaService $dosenpaService)
    {
        $this->adminprodiService = $adminprodiService;
        $this->mahasiswaService = $mahasiswaService;
        $this->dosenpaService = $dosenpaService;
    }

    public function viewAdminprodi()
    {
        $mahasiswa = $this->mahasiswaService->getAll();
        $dosenpa = $this->dosenpaService->getAll();

        return view('adminprodi.dashboard', compact('mahasiswa', 'dosenpa'));
    }
    public function viewKelolaPengguna(Request $request)
    {
        $role = $request->input('role');
        $data = $this->adminprodiService->getDataByRole($role);

        return view('adminprodi.kelola-pengguna.view', compact('data', 'role'));
    }
    public function viewPrestasiAkademik()
    {
        return view('adminprodi.prestasi-akademik.index');
    }
}
