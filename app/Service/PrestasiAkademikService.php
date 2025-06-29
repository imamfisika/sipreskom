<?php

namespace App\Service;

use App\Models\Nilai;

class PrestasiAkademikService
{
    public function getAllNilaiWithRelasi()
    {
        return Nilai::with(['user', 'matkul'])->get();
    }

    public function delete($id)
    {
        return Nilai::findOrFail($id)->delete();
    }
}
