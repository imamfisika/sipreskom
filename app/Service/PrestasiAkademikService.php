<?php

namespace App\Service;

use App\Models\Nilai;

class PrestasiAkademikService
{
    public function getAllNilaiWithRelasi()
    {
        return Nilai::with(['user', 'matkul'])->paginate(7, ['*'], 'nilai_page');
    }

    public function delete($id)
    {
        return Nilai::findOrFail($id)->delete();
    }
    public function getMatkulWajibUlang($idUser)
    {
        $nilaiAman = ['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C'];

        $nilaiGrouped = Nilai::with('matkul')
            ->where('id_user', $idUser)
            ->get()
            ->groupBy('id_matkul');

        $harusUlang = [];

        foreach ($nilaiGrouped as $group) {
            $nilaiTerbaik = $group->sortByDesc('bobot')->first();

            if (!in_array(strtoupper($nilaiTerbaik->nilai), $nilaiAman)) {
                $harusUlang[] = [
                    'kode_matkul' => $nilaiTerbaik->matkul->kode_matkul,
                    'nama_matkul' => $nilaiTerbaik->matkul->nama_matkul,
                    'nilai' => strtoupper($nilaiTerbaik->nilai),
                ];
            }
        }

        return $harusUlang;
    }
}
