<?php

namespace App\Service;

use App\Models\Rekomendasi;
use App\Models\User;
use App\Models\Matkul;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AdminprodiHelper;

class RekomendasiService
{
    public function simpanRekomendasi(array $data)
    {
        $user = User::where('nim', $data['nim'])->firstOrFail();

        Rekomendasi::create([
            'id_user' => $user->id,
            'id_matkul' => $data['id_matkul'],
            'nama_dosen' => $data['nama_dosen'],
            'keterangan' => $data['keterangan'],
        ]);
    }

    public function getRekomendasiByMahasiswa($userId)
    {
        $raw = Rekomendasi::where('id_user', $userId)
            ->join('matkuls', 'rekomendasis.id_matkul', '=', 'matkuls.id')
            ->select('rekomendasis.*', 'matkuls.nama_matkul')
            ->orderBy('rekomendasis.created_at', 'desc')
            ->get();

        $grouped = $raw->groupBy(function ($item) {
            return $item->created_at . '|' . $item->keterangan . '|' . $item->nama_dosen;
        });

        return $grouped->map(function ($items, $key) {
            [$created_at, $keterangan, $nama_dosen] = explode('|', $key);

            return (object) [
                'created_at' => $created_at,
                'keterangan' => $keterangan,
                'nama_dosen' => $nama_dosen,
                'matkuls' => $items->pluck('nama_matkul')->unique()->values(),
            ];
        })->values();
    }
    public function getRekomendasiGroupedByDosen($namaDosen)
    {
        $data = Rekomendasi::with(['matkul', 'mahasiswa'])
            ->where('nama_dosen', $namaDosen)
            ->orderBy('created_at', 'desc')
            ->get();

        return $data->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d H:i:s') . '|' . $item->id_user . '|' . $item->keterangan;
        })->map(function ($group) {
            $first = $group->first();

            return (object)[
                'created_at' => $first->created_at,
                'mahasiswa' => $first->mahasiswa,
                'nama_dosen' => $first->nama_dosen,
                'keterangan' => $first->keterangan,
                'matkuls' => $group->pluck('matkul.nama_matkul')->filter()->unique()->values(),
            ];
        })->values();
    }

    public function getRekomendasiForDosen($dosenNim)
    {
        $dosen = User::where('nim', $dosenNim)->first();

        return Rekomendasi::where('nama_dosen', $dosen->nama)
            ->join('users', 'rekomendasis.id_user', '=', 'users.id')
            ->join('matkuls', 'rekomendasis.id_matkul', '=', 'matkuls.id')
            ->select('rekomendasis.*', 'users.nama as nama_mahasiswa', 'matkuls.nama_matkul')
            ->orderBy('rekomendasis.created_at', 'desc')
            ->get();
    }

    public function getDaftarMatkul()
    {
        return Matkul::all();
    }
    public function simpanRekomendasis($request)
    {
        $user = AdminprodiHelper::getUserByNim($request->nim);
        foreach ($request->id_matkul as $id_matkul) {
            if ($id_matkul) {
                Rekomendasi::create([
                    'id_user' => $user->id,
                    'id_matkul' => $id_matkul,
                    'keterangan' => $request->keterangan,
                    'nama_dosen' => Auth::user()->nama,
                ]);
            }
        }
    }
}
