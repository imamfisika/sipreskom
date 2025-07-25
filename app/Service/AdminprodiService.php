<?php

namespace App\Service;

use App\Helpers\AdminprodiHelper;
use App\Service\MahasiswaService;
use App\Service\DosenpaService;
use App\Models\Akademik;
use App\Models\Matkul;
use App\Models\User;
use App\Models\Nilai;
use App\Imports\NilaiImport;
use App\Imports\AkademikImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

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
        return Akademik::with('user')->orderBy('created_at', 'desc')->paginate(7, ['*'], 'akademik_page');
    }

    public function getAllMatkuls()
    {
        return Matkul::orderBy('kode_matkul')->paginate(7, ['*'], 'matkul_page');
    }

    public function deletePrestasi($id)
    {
        Akademik::findOrFail($id)->delete();
    }

    public function deleteMatkul($id)
    {
        $matkul = Matkul::findOrFail($id);

        if ($matkul->nilais()->exists()) {
            throw new \Exception('Mata kuliah tidak dapat dihapus karena sudah memiliki nilai.');
        }

        $matkul->delete();
    }

    public function storeAkademik(array $data)
    {
        validator($data, [
            'nim' => 'required|string',
            'semester' => 'required|integer',
            'jml_sks' => 'required|integer',
            'ip' => 'required|numeric',
        ])->validate();

        $user = AdminprodiHelper::getUserByNim($data['nim']);
        AdminprodiHelper::cekDuplikatAkademik($user->id, $data['semester']);

        Akademik::create([
            'id_user' => $user->id,
            'semester' => $data['semester'],
            'jml_sks' => $data['jml_sks'],
            'IP' => $data['ip'],
        ]);
    }

    public function storeMatkul(array $data)
    {
        $nama = trim(preg_replace('/[\r\n\t]+/', '', $data['nama_matkul']));
        AdminprodiHelper::validasiNamaMatkul($nama);

        if (Matkul::where('kode_matkul', $data['kode_matkul'])->exists()) {
            throw new \Exception('Kode matkul sudah digunakan.');
        }

        Matkul::create([
            'kode_matkul' => $data['kode_matkul'],
            'nama_matkul' => $nama,
            'jml_sks' => $data['jml_sks'],
        ]);
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
    public function importNilaiFromExcel($file)
    {
        Excel::import(new NilaiImport($this), $file);
    }
    public function getStatusAdminprodi(): array
    {
        $jumlahMatkul = Matkul::count();
        $jumlahMahasiswa = User::where('role', 'mahasiswa')->count();
        $jumlahDosenpa = User::where('role', 'dosenpa')
            ->where('nim', '!=', '197511212005012004')
            ->count();

        return [
            'matkul' => $jumlahMatkul,
            'mahasiswa' => $jumlahMahasiswa,
            'dosenpa' => $jumlahDosenpa,
        ];
    }
    public function importAkademikExcel($file)
    {
        Excel::import(new AkademikImport, $file);
    }

    public function updateUserPassword(string $nim, string $password)
    {
        $user = User::where('nim', $nim)->firstOrFail();
        $user->password = Hash::make($password);
        $user->save();
    }
}
