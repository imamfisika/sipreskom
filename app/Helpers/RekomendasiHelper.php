<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class RekomendasiHelper
{
    public static function groupRekomendasi(Collection $rekomendasi)
    {
        if ($rekomendasi->isEmpty()) {
            return collect();
        }

        $grouped = $rekomendasi->groupBy(function ($item) {
            return $item->created_at . '|' . $item->keterangan . '|' . $item->nama_dosen;
        });

        return $grouped->map(function ($items, $key) {
            [$created_at, $keterangan, $nama_dosen] = explode('|', $key);

            return (object)[
                'created_at' => $created_at,
                'keterangan' => $keterangan,
                'nama_dosen' => $nama_dosen,
                'group' => $items->map(function ($item) {
                    return (object)[
                        'matkul_rekomendasi' => $item->matkul->nama_matkul ?? '-',
                    ];
                }),
            ];
        })->values();
    }
}