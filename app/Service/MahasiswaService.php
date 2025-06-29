<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class MahasiswaService
{
    public function getAll()
    {
        return User::where('role', 'mahasiswa')
            ->select('id', 'nama', 'nim', 'email')
            ->get();
    }
    public function findById($id)
    {
        return User::where('role', 'mahasiswa')->findOrFail($id);
    }
    public function update($id, array $data)
    {
        $user = $this->findById($id);

        $user->update([
            'name'  => $data['nama'],
            'nim'   => $data['nim'],
            'email' => $data['email'],
        ]);
    }
    public function findByNim($nim)
    {
        return User::where('role', 'mahasiswa')->where('nim', $nim)->firstOrFail();
    }
    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
    public function getRiwayatAkademik($userId)
    {
        return DB::table('nilais')
            ->join('matkuls', 'nilais.id_matkul', '=', 'matkuls.id')
            ->where('nilais.id_user', $userId)
            ->select('matkuls.nama_matkul', 'matkuls.kode_matkul', 'matkuls.jml_sks', 'nilais.bobot', 'nilais.nilai')
            ->orderBy('matkuls.nama_matkul')
            ->get();
    }
    public function getIpkSks($userId)
    {
        $akademiks = \App\Models\Akademik::where('id_user', $userId)->get();

        $totalSks = $akademiks->sum('jml_sks');
        $totalIp = $akademiks->sum('IP');
        $jumlahSemester = $akademiks->count();

        $ipk = $jumlahSemester > 0 ? round($totalIp / $jumlahSemester, 2) : 0;

        return [
            'total_sks' => $totalSks,
            'ipk' => $ipk,
        ];
    }
}
