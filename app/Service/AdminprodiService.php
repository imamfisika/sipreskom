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
        $existing = Matkul::where('kode_matkul', $data['kode_matkul'])->first();
        if (!preg_match('/^[a-zA-Z\s\-]+$/', $data['nama_matkul'])) {
            throw new \Exception('Nama matkul hanya boleh huruf, spasi, dan tanda minus (-).');
        }
        if ($existing) {
            throw new \Exception('Kode matkul sudah digunakan.');
        }

        Matkul::create($data);
    }

    public function storeNilai(array $data)
    {
        if (!is_numeric($data['bobot']) || !is_numeric($data['semester'])) {
            throw new \Exception("Bobot dan semester harus berupa angka.");
        }

        if (!preg_match('/^[A-Ea-e][+-]?$/', $data['nilai'])) {
            throw new \Exception("Format nilai tidak valid. Contoh yang valid: A, B+, C-");
        }

        $user = User::where('nim', $data['nim'])->first();
        if (!$user) {
            throw new \Exception("User dengan NIM {$data['nim']} tidak ditemukan.");
        }

        $matkul = Matkul::where('kode_matkul', $data['kode_matkul'])->first();
        if (!$matkul) {
            throw new \Exception("Mata kuliah dengan kode {$data['kode_matkul']} tidak ditemukan.");
        }

        Nilai::create([
            'id_user' => $user->id,
            'id_matkul' => $matkul->id,
            'bobot' => $data['bobot'],
            'nilai' => strtoupper($data['nilai']),
            'semester' => $data['semester'],
        ]);
    }
}
