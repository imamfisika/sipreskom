<?php

namespace App\Service;

use App\Service\MahasiswaService;
use App\Service\DosenpaService;
use App\Models\Akademik;
use App\Models\Matkul;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\User;


class AdminprodiService
{
    protected $mahasiswaService;
    protected $dosenpaService;

    public function __construct(MahasiswaService $mahasiswaService, DosenpaService $dosenpaService)
    {
        $this->mahasiswaService = $mahasiswaService;
        $this->dosenpaService = $dosenpaService;
    }

    public function getDataByRole(?string $role): array
    {
        $data = [];

        if ($role === 'mahasiswa') {
            $data[$role] = $this->mahasiswaService->getAll();
        } elseif ($role === 'dosen') {
            $data[$role] = $this->dosenpaService->getAll();
        }

        return $data;
    }
    public function getAllPrestasi()
    {
        return Akademik::with('user')->get();
    }

    public function deletePrestasi($id)
    {
        Akademik::findOrFail($id)->delete();
    }

    public function storeAkademik(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
            'semester' => 'required|integer',
            'jml_sks' => 'required|integer',
            'ip' => 'required|numeric',
        ]);

        $user = User::where('nim', $request->nim)->first();

        if (!$user) {
            throw new \Exception("User dengan NIM tersebut tidak ditemukan.");
        }

        $existing = Akademik::where('id_user', $user->id)
            ->where('semester', $request->semester)
            ->first();

        if ($existing) {
            throw new \Exception("Data dengan NIM {$request->nim} pada semester {$request->semester} sudah ada.");
        }

        Akademik::create([
            'id_user' => $user->id,
            'semester' => $request->semester,
            'jml_sks' => $request->jml_sks,
            'IP' => $request->ip,
        ]);
    }

    public function storeMatkul(array $data)
    {
        Matkul::create($data);
    }

    public function storeNilai(array $data)
    {
        $user = User::where('nim', $data['nim'])->first();
        if (!$user) {
            throw new \Exception("NIM tidak ditemukan.");
        }

        $matkul = Matkul::where('kode_matkul', $data['kode_matkul'])->first();
        if (!$matkul) {
            throw new \Exception("Kode matkul tidak ditemukan.");
        }

        if (!is_numeric($data['bobot']) || !is_numeric($data['semester'])) {
            throw new \Exception("Bobot dan semester harus berupa angka.");
        }

    //     $existing = Nilai::where('id_user', $user->id)
    //     ->where('id_matkul', $matkul->id)
    //     ->where('semester', $data['semester'])
    //     ->first();

    // if ($existing) {
    //     throw new \Exception("Data nilai ini sudah ada.");
    // }

        Nilai::create([
            'id_user'   => $user->id,
            'id_matkul' => $matkul->id,
            'bobot'     => $data['bobot'],
            'nilai'     => $data['nilai'],
            'semester'  => $data['semester'],
        ]);
    }
}
