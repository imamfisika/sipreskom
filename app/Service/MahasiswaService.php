<?php

namespace App\Service;

use App\Models\User;
use App\Models\Rekomendasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
    public function getRekomendasiMahasiswa()
    {
        $mahasiswa = Auth::user();

        return Rekomendasi::where('id_user', $mahasiswa->id)
            ->select('nama_dosen', 'keterangan')
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function getGroupedRekomendasiMahasiswa()
    {
        $mahasiswa = Auth::user();

        return Rekomendasi::with('matkul')
            ->where('id_user', $mahasiswa->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d H:i:s');
            });
    }
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::find(Auth::id());
        if (!$user) {
            throw new \Exception('User not found.');
        }

        $foto = $request->file('foto');
        $filename = 'profil_' . $user->id . '.' . $foto->getClientOriginalExtension();
        $foto->storeAs('public/images', $filename);

        $user->foto = $filename;
        $user->save();
    }
}
