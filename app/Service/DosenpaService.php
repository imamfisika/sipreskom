<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\AkademikHelper;
use Illuminate\Http\Request;
use App\Models\Rekomendasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DosenpaService
{
    public function getAll()
    {
        return User::where('role', 'dosenpa')->select('id', 'nama', 'nim', 'email')->get();
    }

    public function findById($id)
    {
        return User::where('role', 'dosenpa')->findOrFail($id);
    }

    public function findByNim($nim)
    {
        return User::where('role', 'dosenpa')->where('nim', $nim)->firstOrFail();
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);
    }

    public function delete($id)
    {
        return $this->findById($id)->delete();
    }

    public function getMahasiswaBimbingan()
    {
        $dosen = Auth::user();
        $query = AkademikHelper::filterMahasiswaBimbinganQuery($dosen->nim);

        $mahasiswa = $query instanceof \Illuminate\Support\Collection ? $query : $query->get();

        return $mahasiswa->map(function ($mhs) {
            $ipksks = AkademikHelper::hitungIpkDanSks($mhs);
            return [
                'id' => $mhs->id,
                'nama' => $mhs->nama,
                'nim' => $mhs->nim,
                'total_sks' => $ipksks['total_sks'],
                'ipk' => $ipksks['ipk'],
            ];
        });
    }

    public function getMahasiswaByNim($nim)
    {
        return User::where('role', 'mahasiswa')->where('nim', $nim)->firstOrFail();
    }

    public function getRiwayatAkademikByNim($nim)
    {
        $user = $this->getMahasiswaByNim($nim);

        return DB::table('nilais')
            ->join('matkuls', 'nilais.id_matkul', '=', 'matkuls.id')
            ->where('nilais.id_user', $user->id)
            ->select('matkuls.nama_matkul', 'matkuls.kode_matkul', 'matkuls.jml_sks', 'nilais.bobot', 'nilais.nilai')
            ->get();
    }

    public function getAkademikSummaryByNim($nim)
    {
        $user = $this->getMahasiswaByNim($nim);
        return AkademikHelper::hitungIpkDanSks($user);
    }

    public function getDetailAkademikMahasiswa($nim)
    {
        $mahasiswa = $this->getMahasiswaByNim($nim);
        $riwayat   = $this->getRiwayatAkademikByNim($nim);
        $ipksks    = $this->getAkademikSummaryByNim($nim);

        return compact('mahasiswa', 'riwayat', 'ipksks');
    }

    public function getMatkulBelumDiambilByNim($nim)
    {
        return DB::table('matkuls')
            ->select('id', 'nama_matkul')
            ->get();
    }

    public function getDefaultMatkulBelumDiambil($mahasiswaCollection)
    {
        return DB::table('matkuls')
            ->select('id', 'nama_matkul')
            ->get();
    }
    public function validateRekomendasiRequest(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:users,nim',
            'id_matkul' => 'required|array|min:1',
            'id_matkul.*' => 'exists:matkuls,id',
            'keterangan' => 'required|string|max:255',
        ]);
    }
    public function getRekomendasiByMahasiswa($userId)
    {
        $raw = Rekomendasi::where('id_user', $userId)
            ->join('matkuls', 'rekomendasis.id_matkul', '=', 'matkuls.id')
            ->select('rekomendasis.*', 'matkuls.nama_matkul as matkul_rekomendasi')
            ->orderBy('rekomendasis.created_at', 'desc')
            ->get();

        if ($raw->isEmpty()) {
            return collect();
        }

        $grouped = $raw->groupBy(function ($item) {
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
                        'matkul_rekomendasi' => $item->matkul_rekomendasi,
                    ];
                }),
            ];
        })->values();
    }
    public function getFormRekomendasiData()
    {
        $nama_dosen = Auth::user()->nama;
        $mahasiswa = $this->getMahasiswaBimbingan();
        $matkuls = $this->getDefaultMatkulBelumDiambil($mahasiswa);

        return compact('nama_dosen', 'mahasiswa', 'matkuls');
    }

    public function generateLaporanAkademik($dosen, $mahasiswa)
    {
        return Pdf::loadView('dosenpa.prestasi-akademik.cetakLaporan', compact('dosen', 'mahasiswa'))
            ->setPaper('a4', 'landscape');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail(Auth::id());

        if ($user->foto && Storage::exists('public/images/' . $user->foto)) {
            Storage::delete('public/images/' . $user->foto);
        }

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/images', $filename);

        $user->update(['foto' => $filename]);
    }
    public function getGroupedRekomendasiMahasiswaByNim(string $nim)
{
    $user = $this->getMahasiswaByNim($nim);

    $raw = Rekomendasi::with('matkul')
        ->where('id_user', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    if ($raw->isEmpty()) {
        return collect();
    }

    $grouped = $raw->groupBy(function ($item) {
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
