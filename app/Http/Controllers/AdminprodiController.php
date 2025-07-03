<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MahasiswaService;
use App\Service\DosenpaService;
use App\Service\AdminprodiService;
use App\Service\AkademikService;
use App\Service\PrestasiAkademikService;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Matkul;

class AdminprodiController extends Controller
{
    protected $adminprodiService;
    protected $mahasiswaService;
    protected $dosenpaService;
    protected $akademikService;
    protected $prestasiAkademikService;

    public function __construct(
        AdminprodiService $adminprodiService,
        MahasiswaService $mahasiswaService,
        DosenpaService $dosenpaService,
        AkademikService $akademikService,
        PrestasiAkademikService $prestasiAkademikService
    ) {
        $this->adminprodiService = $adminprodiService;
        $this->mahasiswaService = $mahasiswaService;
        $this->dosenpaService = $dosenpaService;
        $this->akademikService = $akademikService;
        $this->prestasiAkademikService = $prestasiAkademikService;
    }

    public function viewAdminprodi()
    {
        $mahasiswa = $this->mahasiswaService->getAll();
        $dosenpa = $this->dosenpaService->getAll();
        $status = $this->adminprodiService->getStatusAdminprodi();

        return view('adminprodi.dashboard', compact('mahasiswa', 'dosenpa', 'status'));
    }

    public function viewKelolaPengguna(Request $request)
    {
        $role = $request->input('role');
        $data = $this->adminprodiService->getDataByRole($role);

        return view('adminprodi.kelola-pengguna.view', compact('data', 'role'));
    }

    public function viewKelolaPrestasi()
    {
        $akademiks = $this->adminprodiService->getAllPrestasi();
        $nilais = $this->prestasiAkademikService->getAllNilaiWithRelasi();
        $matkuls = $this->adminprodiService->getAllMatkuls();

        return view('adminprodi.prestasi-akademik.view', compact('akademiks', 'nilais', 'matkuls'));
    }


    public function deletePrestasi($id)
    {
        $this->adminprodiService->deletePrestasi($id);
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function deleteDaftarNilai($id)
    {
        $this->prestasiAkademikService->delete($id);
        return redirect()->back()->with('success', 'Data nilai berhasil dihapus.');
    }

    public function deleteMatkul($id)
    {
        try {
            $this->adminprodiService->deleteMatkul($id);
            return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('adminprodi.prestasi-akademik.tambah');
    }

    public function storeAkademik(Request $request)
    {
        try {
            $this->adminprodiService->storeAkademik($request->only(['nim', 'semester', 'jml_sks', 'ip']));
            return back()->with('success', 'Data akademik berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function storeMatkul(Request $request)
    {
        try {
            $this->adminprodiService->storeMatkul($request->only(['kode_matkul', 'nama_matkul', 'jml_sks']));
            return back()->with('success', 'Data matkul berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function storeNilai(Request $request)
    {
        try {
            $this->adminprodiService->storeNilai($request->only([
                'nim',
                'kode_matkul',
                'bobot',
                'nilai',
                'semester'
            ]));
            return back()->with('success', 'Data nilai berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
    public function importAkademikExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            $this->adminprodiService->importAkademikExcel($request->file('file'));
            return back()->with('success', 'Import data akademik berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Import gagal: ' . $e->getMessage()]);
        }
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        try {
            app(AdminprodiService::class)->importNilaiFromExcel($request->file('excel_file'));
            return back()->with('success', 'Data nilai berhasil diimpor.');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal impor: ' . $e->getMessage()]);
        }
    }
    public function importMatkulExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new \App\Imports\MatkulImport, $request->file('file'));
            return back()->with('success', 'Data mata kuliah berhasil diimport.');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
