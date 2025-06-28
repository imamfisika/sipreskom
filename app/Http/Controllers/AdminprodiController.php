<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MahasiswaService;
use App\Service\DosenpaService;
use App\Service\AdminprodiService;
use App\Service\AkademikService;




class AdminprodiController extends Controller
{
    protected $adminprodiService;
    protected $mahasiswaService;
    protected $dosenpaService;
    protected $akademikService;

    public function __construct(AdminprodiService $adminprodiService, MahasiswaService $mahasiswaService, DosenpaService $dosenpaService, AkademikService $akademikService)
    {
        $this->adminprodiService = $adminprodiService;
        $this->mahasiswaService = $mahasiswaService;
        $this->dosenpaService = $dosenpaService;
        $this->akademikService = $akademikService;
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
    public function viewKelolaPrestasi()
    {
        $data = $this->adminprodiService->getAllPrestasi();
        return view('adminprodi.prestasi-akademik.view', compact('data'));
    }
    public function deletePrestasi($id)
    {
        $this->adminprodiService->deletePrestasi($id);
        return back()->with('success', 'Data berhasil dihapus');
    }
}
