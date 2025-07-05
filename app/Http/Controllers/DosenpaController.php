<?php

namespace App\Http\Controllers;

use App\Service\DosenpaService;
use App\Service\UserService;
use App\Service\RekomendasiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\PrestasiAkademikService;
use App\Service\MahasiswaService;


class DosenpaController extends Controller
{
    protected $userService;
    protected $dosenpaService;
    protected $rekomendasiService;
    protected $mahasiswaService;
    protected $prestasiAkademikService;

    public function __construct(UserService $userService, DosenpaService $dosenpaService, RekomendasiService $rekomendasiService, MahasiswaService $mahasiswaService, PrestasiAkademikService $prestasiAkademikService)
    {
        $this->userService = $userService;
        $this->dosenpaService = $dosenpaService;
        $this->rekomendasiService = $rekomendasiService;
        $this->mahasiswaService = $mahasiswaService;
        $this->prestasiAkademikService = $prestasiAkademikService;
    }

    public function viewDosenpa()
    {
        $mahasiswa = $this->dosenpaService->getMahasiswaBimbingan();
        $statusData = $this->dosenpaService->getStatusPrestasiMahasiswa();
        $grafik = $this->dosenpaService->getGrafikStatistikIpMahasiswa();

        return view('dosenpa.dashboard', compact('mahasiswa', 'statusData', 'grafik'));
    }

    public function viewRekomendasi()
    {
        $dosen = Auth::user();
        $rekomendasis = $this->rekomendasiService->getRekomendasiGroupedByDosen($dosen->nama);

        return view('dosenpa.rekomendasi.view', compact('rekomendasis'));
    }


    public function formTambahRekomendasi()
    {
        $data = $this->dosenpaService->getFormRekomendasiData();

        return view('dosenpa.rekomendasi.tambah', $data);
    }

    public function getMatkulBelumDiambilByNim($nim)
    {
        $matkuls = $this->dosenpaService->getMatkulBelumDiambilByNim($nim);
        return response()->json($matkuls);
    }

    public function simpanRekomendasi(Request $request)
    {
        $this->dosenpaService->validateRekomendasiRequest($request);
        $this->rekomendasiService->simpanRekomendasis($request);

        return redirect()->route('dosenpa.rekomendasi.view')->with('success', 'Rekomendasi berhasil ditambahkan.');
    }

    public function viewPrestasiAkademik()
    {
        $mahasiswa = $this->dosenpaService->getMahasiswaBimbingan();
        $statusData = $this->dosenpaService->getStatusPrestasiMahasiswa();
        $grafik = $this->dosenpaService->getGrafikStatistikIpMahasiswa();


        return view('dosenpa.prestasi-akademik.index', compact('mahasiswa', 'statusData', 'grafik'));
    }

    public function viewPrestasiAkademikMahasiswa($nim)
    {
        $data = $this->dosenpaService->getDetailAkademikMahasiswa($nim);

        if (!$data) {
            return redirect()->route('dosenpa.prestasi-akademik.index')
                ->with('error', "Mahasiswa dengan NIM '$nim' tidak ditemukan.");
        }

        $user = $data['mahasiswa'];
        $rekomendasis = $this->dosenpaService->getGroupedRekomendasiMahasiswaByNim($nim);

        $grafik = $this->mahasiswaService->getGrafikIpMahasiswa($user->id) ?? ['ipData' => [], 'avgData' => [], 'deskripsi' => ''];
        $matkulUlang = app(PrestasiAkademikService::class)->getMatkulWajibUlang($user->id);

        return view('dosenpa.prestasi-akademik.mahasiswa', array_merge($data, [
            'rekomendasis' => $rekomendasis,
            'ipData' => $grafik['ipData'],
            'ipAvgData' => $grafik['avgData'],
            'deskripsi' => $grafik['deskripsi'],
            'matkulUlang' => $matkulUlang,
            'user' => $user,
        ]));
    }

    public function viewLaporanAkademik()
    {
        $mahasiswa = $this->dosenpaService->getMahasiswaBimbingan();
        return view('dosenpa.prestasi-akademik.laporan', compact('mahasiswa'));
    }

    public function unduhLaporan()
    {
        $dosen = Auth::user();
        $mahasiswa = $this->dosenpaService->getMahasiswaBimbingan();
        $pdf = $this->dosenpaService->generateLaporanAkademik($dosen, $mahasiswa);

        return $pdf->stream('dosenpa.prestasi-akademik.cetakLaporan');
    }

    public function viewProfile()
    {
        $user = Auth::user();
        $mahasiswa = $this->dosenpaService->getMahasiswaBimbingan();
        $jumlahMahasiswaBimbingan = $mahasiswa->count();

        return view('dosenpa.profile', compact('user', 'mahasiswa', 'jumlahMahasiswaBimbingan'));
    }

    public function updatePhoto(Request $request)
    {
        $this->dosenpaService->updatePhoto($request);

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
