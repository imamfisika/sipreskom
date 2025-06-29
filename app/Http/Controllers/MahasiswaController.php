<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use App\Service\MahasiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MahasiswaController extends Controller
{
    protected $mahasiswaService;
    protected $userService;

    public function __construct(MahasiswaService $mahasiswaService, UserService $userService)
    {
        $this->mahasiswaService = $mahasiswaService;
        $this->userService = $userService;
    }

    public function viewMahasiswa()
    {
        $user = Auth::user();
        $riwayatAkademik = $this->mahasiswaService->getRiwayatAkademik($user->id);
        $ipksks = app(MahasiswaService::class)->getIpkSks($user->id);

        return view('mahasiswa.dashboard', compact('user', 'riwayatAkademik', 'ipksks'));
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
        return view('mahasiswa.rekomendasi');
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
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $this->userService->updateProfilePhoto(Auth::id(), $request->file('foto'));

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
