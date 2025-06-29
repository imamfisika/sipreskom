<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\AkademikHelper;

class DosenpaService
{
    public function getAll()
    {
        return User::where('role', 'dosenpa')
            ->select('id', 'nama', 'nim', 'email')
            ->get();
    }

    public function findById($id)
    {
        return User::where('role', 'dosenpa')->findOrFail($id);
    }

    public function findByNim($nim)
    {
        return User::where('role', 'dosenpa')->where('nim', $nim)->firstOrFail();
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);

        $user->update([
            'nama'  => $data['nama'],
            'nim'   => $data['nim'],
            'email' => $data['email'],
        ]);
    }

    public function delete($id)
    {
        return $this->findById($id)->delete();
    }

    public function getMahasiswaBimbingan()
    {
        $dosenpa = Auth::user();
        $query = AkademikHelper::filterMahasiswaBimbinganQuery($dosenpa->nim);

        if ($query instanceof \Illuminate\Support\Collection) {
            $mahasiswa = $query;
        } else {
            $mahasiswa = $query->get();
        }

        return $mahasiswa->map(function ($mhs) {
            $ipksks = AkademikHelper::hitungIpkDanSks($mhs);

            return [
                'nama' => $mhs->nama,
                'nim' => $mhs->nim,
                'total_sks' => $ipksks['total_sks'],
                'ipk' => $ipksks['ipk'],
            ];
        });
    }

    public function getMahasiswaByNim($nim)
    {
        return User::where('role', 'mahasiswa')->where('nim', $nim)->firstOrFail();
    }

    public function getRiwayatAkademikByNim($nim)
    {
        $user = $this->getMahasiswaByNim($nim);

        return DB::table('nilais')
            ->join('matkuls', 'nilais.id_matkul', '=', 'matkuls.id')
            ->where('nilais.id_user', $user->id)
            ->select(
                'matkuls.nama_matkul',
                'matkuls.kode_matkul',
                'matkuls.jml_sks',
                'nilais.bobot',
                'nilais.nilai'
            )
            ->get();
    }

    public function getAkademikSummaryByNim($nim)
    {
        $user = $this->getMahasiswaByNim($nim);
        return AkademikHelper::hitungIpkDanSks($user);
    }

    public function getDetailAkademikMahasiswa($nim)
    {
        $mahasiswa = $this->getMahasiswaByNim($nim);
        $riwayat = $this->getRiwayatAkademikByNim($nim);
        $ipksks = $this->getAkademikSummaryByNim($nim);

        return compact('mahasiswa', 'riwayat', 'ipksks');
    }
}