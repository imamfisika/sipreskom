<?php

namespace App\Helpers;

use App\Models\Akademik;
use App\Models\User;

class AkademikHelper
{
    public static function hitungIpkDanSks(User $user): array
    {
        $akademik = Akademik::where('id_user', $user->id)->get();

        $totalSks = $akademik->sum('jml_sks');
        $jumlahSemester = $akademik->count();
        $totalIp = $akademik->sum('IP');
        $ipk = $jumlahSemester > 0 ? round($totalIp / $jumlahSemester, 2) : 0;

        return [
            'total_sks' => $totalSks,
            'ipk' => $ipk,
        ];
    }

    public static function filterMahasiswaBimbinganQuery(string $nimDosen)
    {
        $query = User::where('role', 'mahasiswa');

        return match ($nimDosen) {
            '197511212005012004' => $query, 
            '196605171994031003' => $query->whereRaw('CAST(RIGHT(nim, 1) AS UNSIGNED) % 2 = 1'), 
            '198811022022031002' => $query->whereRaw('CAST(RIGHT(nim, 1) AS UNSIGNED) % 2 = 0'), 
            default => User::whereRaw('0 = 1'), 
        };
    }
}