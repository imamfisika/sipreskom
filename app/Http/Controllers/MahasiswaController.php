<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use App\Service\MahasiswaService;
use App\Service\RekomendasiService;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MahasiswaController extends Controller
{
    protected $mahasiswaService;
    protected $userService;
    protected $rekomendasiService;

    public function __construct(MahasiswaService $mahasiswaService, UserService $userService, RekomendasiService $rekomendasiService)
    {
        $this->mahasiswaService = $mahasiswaService;
        $this->userService = $userService;
        $this->rekomendasiService = $rekomendasiService;
    }

    public function viewMahasiswa()
    {
        $user = Auth::user();
        $riwayatAkademik = $this->mahasiswaService->getRiwayatAkademik($user->id);
        $ipksks = app(MahasiswaService::class)->getIpkSks($user->id);
        $rekomendasis = $this->mahasiswaService->getRekomendasiMahasiswa();

        return view('mahasiswa.dashboard', compact('user', 'riwayatAkademik', 'ipksks', 'rekomendasis'));
    }
    public function viewPrestasiAkademik()
    {
        $user = Auth::user();
        $data = $this->mahasiswaService->getRiwayatAkademik($user->id);
        $ipksks = $this->mahasiswaService->getIpkSks($user->id);

        return view('mahasiswa.prestasi-akademik.index', compact('data', 'ipksks'));
    }
    public function viewRekomendasi()
    {
        $rekomendasis = $this->mahasiswaService->getGroupedRekomendasiMahasiswa();

        return view('mahasiswa.rekomendasi', compact('rekomendasis'));
    }
    public function viewProfile()
    {
        $user = Auth::user();
        $nim = $user->nim;
        $mahasiswa = $this->mahasiswaService->findByNim($nim);
        $ipksks = app(MahasiswaService::class)->getIpkSks($user->id);

        return view('mahasiswa.profile', compact('mahasiswa', 'ipksks', 'user'));
    }
    public function updatePhoto(Request $request)
    {
        $this->mahasiswaService->updatePhoto($request);

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
