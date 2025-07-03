<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use App\Service\MahasiswaService;
use App\Service\RekomendasiService;
use App\Service\PrestasiAkademikService;
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
        $riwayatAkademik = $this->mahasiswaService->getRiwayatAkademik(userId: $user->id)->sortByDesc('created_at')->take(4);
        $ipksks = $this->mahasiswaService->getIpkSks($user->id);
        $rekomendasis = $this->mahasiswaService->getRekomendasiMahasiswa();
        $grafik = $this->mahasiswaService->getGrafikIpMahasiswa($user->id);
        $dosenPa = $this->mahasiswaService->getDosenPaByNim($user->nim);


        return view('mahasiswa.dashboard', [
            'user' => $user,
            'riwayatAkademik' => $riwayatAkademik,
            'ipksks' => $ipksks,
            'rekomendasis' => $rekomendasis,
            'ipData' => $grafik['ipData'],
            'ipAvgData' => $grafik['avgData'],
            'deskripsi' => $grafik['deskripsi'],
            'dosenPa' => $dosenPa,
        ]);
    }
    public function viewPrestasiAkademik()
    {
        $user = Auth::user();
        $data = $this->mahasiswaService->getRiwayatAkademik($user->id);
        $ipksks = $this->mahasiswaService->getIpkSks($user->id);

        $grafik = $this->mahasiswaService->getGrafikIpMahasiswa($user->id);


        return view('mahasiswa.prestasi-akademik.index', [
            'data' => $data,
            'ipksks' => $ipksks,
            'ipData' => $grafik['ipData'],
            'ipAvgData' => $grafik['avgData'],
            'deskripsi' => $grafik['deskripsi'],
        ]);
    }

    public function viewRekomendasi()
    {
        $user = Auth::user();
        $rekomendasis = $this->mahasiswaService->getGroupedRekomendasiMahasiswa();
        $grafik = $this->mahasiswaService->getGrafikIpMahasiswa($user->id);
        $matkulUlang = app(PrestasiAkademikService::class)->getMatkulWajibUlang($user->id);


        return view('mahasiswa.rekomendasi', [
            'user' => $user,
            'rekomendasis' => $rekomendasis,
            'ipData' => $grafik['ipData'],
            'ipAvgData' => $grafik['avgData'],
            'deskripsi' => $grafik['deskripsi'],
            'matkulUlang' => $matkulUlang,
        ]);
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
