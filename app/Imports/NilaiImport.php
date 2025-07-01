<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NilaiImport implements ToCollection
{
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index === 0) continue;

            try {
                $data = [
                    'nim' => $row[0],
                    'kode_matkul' => $row[1],
                    'bobot' => $row[2],
                    'nilai' => $row[3],
                    'semester' => $row[4],
                ];

                $this->service->storeNilai($data);
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}