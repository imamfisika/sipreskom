<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Matkul;
use App\Models\Akademik;
use Illuminate\Validation\ValidationException;

class AdminprodiHelper
{
    public static function validasiNilaiFormat($nilai)
    {
        if (!preg_match('/^[A-Ea-e][+-]?$/', $nilai)) {
            throw new \Exception("Format nilai tidak valid. Contoh yang valid: A, B+, C-");
        }
        return strtoupper($nilai);
    }

    public static function validasiNamaMatkul($nama)
    {
        if (!preg_match('/^[a-zA-Z\s\-]+$/', $nama)) {
            throw new \Exception('Nama matkul hanya boleh huruf, spasi, dan tanda minus (-).');
        }
    }

    public static function getUserByNim($nim)
    {
        $user = User::where('nim', $nim)->first();
        if (!$user) {
            throw new \Exception("User dengan NIM {$nim} tidak ditemukan.");
        }
        return $user;
    }

    public static function getMatkulByKode($kode)
    {
        $matkul = Matkul::where('kode_matkul', $kode)->first();
        if (!$matkul) {
            throw new \Exception("Mata kuliah dengan kode {$kode} tidak ditemukan.");
        }
        return $matkul;
    }

    public static function cekDuplikatAkademik($userId, $semester)
    {
        if (Akademik::where('id_user', $userId)->where('semester', $semester)->exists()) {
            throw new \Exception("Data akademik semester {$semester} sudah ada untuk user ini.");
        }
    }
}