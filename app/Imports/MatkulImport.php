<?php

namespace App\Imports;

use App\Models\Matkul;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Helpers\AdminprodiHelper;

class MatkulImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->skip(1)->each(function ($row) {
            $data = [
                'kode_matkul' => $row[0],
                'nama_matkul' => $row[1],
                'jml_sks'     => $row[2],
            ];

            AdminprodiHelper::validasiNamaMatkul($data['nama_matkul']);

            if (!Matkul::where('kode_matkul', $data['kode_matkul'])->exists()) {
                Matkul::create($data);
            }
        });
    }
}