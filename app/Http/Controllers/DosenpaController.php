<?php

namespace App\Http\Controllers;

use App\Service\DosenpaService;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class DosenpaController extends Controller
{
    protected $userService;
    protected $dosenpaService;


    public function __construct(UserService $userService, DosenpaService $dosenpaService)
    {
        $this->userService = $userService;
        $this->dosenpaService = $dosenpaService;
    }
    public function viewDosenpa()
    {
        $mahasiswa = $this->dosenpaService->getMahasiswaBimbingan();
        return view('dosenpa.dashboard', compact('mahasiswa'));
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
        $mahasiswa = $this->dosenpaService->getMahasiswaBimbingan();
        return view('dosenpa.prestasi-akademik.index', compact('mahasiswa'));
    }

    public function viewPrestasiAkademikMahasiswa($nim)
    {
        try {
            $data = $this->dosenpaService->getDetailAkademikMahasiswa($nim);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dosenpa.prestasi-akademik.index')
                ->with('error', "Mahasiswa dengan NIM '$nim' tidak ditemukan.");
        }

        return view('dosenpa.prestasi-akademik.mahasiswa', [
            'mahasiswa' => $data['mahasiswa'],
            'riwayatAkademik' => $data['riwayat'],
            'ipksks' => $data['ipksks'],
        ]);
    }
    public function viewLaporanAkademik()
    {
        return view('dosenpa.prestasi-akademik.laporan');
    }
    public function viewProfile()
    {
        $user = Auth::user();

        return view('dosenpa.profile', compact('user'));
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
