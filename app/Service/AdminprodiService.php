<?php

namespace App\Service;

use App\Helpers\AdminprodiHelper;
use App\Service\MahasiswaService;
use App\Service\DosenpaService;
use App\Models\Akademik;
use App\Models\Matkul;
use App\Models\Nilai;
use Illuminate\Http\Request;


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

        $user = AdminprodiHelper::getUserByNim($request->nim);

        AdminprodiHelper::cekDuplikatAkademik($user->id, $request->semester);

        Akademik::create([
            'id_user' => $user->id,
            'semester' => $request->semester,
            'jml_sks' => $request->jml_sks,
            'IP' => $request->ip,
        ]);
    }

    public function storeMatkul(array $data)
    {
        AdminprodiHelper::validasiNamaMatkul($data['nama_matkul']);

        if (Matkul::where('kode_matkul', $data['kode_matkul'])->exists()) {
            throw new \Exception('Kode matkul sudah digunakan.');
        }

        Matkul::create($data);
    }

    public function storeNilai(array $data)
    {
        if (!is_numeric($data['bobot']) || !is_numeric($data['semester'])) {
            throw new \Exception("Bobot dan semester harus berupa angka.");
        }

        $nilai = AdminprodiHelper::validasiNilaiFormat($data['nilai']);
        $user = AdminprodiHelper::getUserByNim($data['nim']);
        $matkul = AdminprodiHelper::getMatkulByKode($data['kode_matkul']);

        Nilai::create([
            'id_user' => $user->id,
            'id_matkul' => $matkul->id,
            'bobot' => $data['bobot'],
            'nilai' => $nilai,
            'semester' => $data['semester'],
        ]);
    }
}
