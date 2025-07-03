<?php

namespace App\Imports;

use App\Models\Akademik;
use App\Helpers\AdminprodiHelper;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

class AkademikImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $dataRows = $rows->slice(1);

        foreach ($dataRows as $row) {
            $data = [
                'nim' => trim($row[0]),
                'semester' => (int) $row[1],
                'jml_sks' => (int) $row[2],
                'ip' => (float) $row[3],
            ];

            try {
                Validator::make($data, [
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
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}