<?php

namespace App\Service;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rekomendasi;
use App\Models\Akademik;
use App\Helpers\AkademikHelper;
use App\Helpers\RekomendasiHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


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

        $paginated = $query->paginate(10);

        $transformed = $paginated->getCollection()->map(function ($mhs) {
            $ipksks = AkademikHelper::hitungIpkDanSks($mhs);
            $ipk = $ipksks['ipk'];
    
            $kategoriRank = 0;
            if ($ipk > 3.5) {
                $kategoriRank = 2; 
            } elseif ($ipk >= 3.01) {
                $kategoriRank = 1;
            } else {
                $kategoriRank = 0; 
            }
    
            return [
                'id' => $mhs->id,
                'nama' => $mhs->nama,
                'nim' => $mhs->nim,
                'total_sks' => $ipksks['total_sks'],
                'ipk' => $ipk,
                'rank' => $kategoriRank,
            ];
        })->sortBy('rank')->values();
        
        $paginated->setCollection($transformed);
    
        return $paginated;
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
            ->paginate(10);
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
            ->orderBy('nama_matkul', 'asc')
            ->get();
    }

    public function getFormRekomendasiData()
    {
        $nama_dosen = Auth::user()->nama;
        $mahasiswa = $this->getMahasiswaBimbingan();
        $matkuls = $this->getMatkulBelumDiambilByNim($mahasiswa);

        return compact('nama_dosen', 'mahasiswa', 'matkuls');
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

    public function updateProfilePhoto($id, $photo)
    {
        $user = User::findOrFail($id);

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $path = $photo->store('images', 'public');
        $user->update(['foto' => $path]);
    }

    public function getGroupedRekomendasiMahasiswaByNim(string $nim)
    {
        $user = $this->getMahasiswaByNim($nim);

        $raw = Rekomendasi::with('matkul')
            ->where('id_user', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return RekomendasiHelper::groupRekomendasi($raw);
    }

    public function getStatusPrestasiMahasiswa()
    {
        $dosenNim = Auth::user()->nim;

        // if ($dosenNim === '197511212005012004') {
        
        //     $mahasiswa = User::where('role', 'mahasiswa')->get();
        // } elseif ($dosenNim === '196605171994031003') {
        //     $mahasiswa = User::where('role', 'mahasiswa')
        //         ->whereRaw('MOD(CAST(nim AS UNSIGNED), 2) = 1')
        //         ->get();
        // } elseif ($dosenNim === '198811022022031002') {
        //     $mahasiswa = User::where('role', 'mahasiswa')
        //         ->whereRaw('MOD(CAST(nim AS UNSIGNED), 2) = 0')
        //         ->get();
        // } else {
        //     return [
        //         'total' => 0,
        //         'berprestasi' => 0,
        //         'cukup' => 0,
        //         'kurang' => 0,
        //     ];
        // }

        if ($dosenNim === '196605171994031003') {
            $mahasiswa = User::where('role', 'mahasiswa')
                ->whereRaw('MOD(CAST(nim AS UNSIGNED), 2) = 1')
                ->get();
        } elseif ($dosenNim === '198811022022031002') {
            $mahasiswa = User::where('role', 'mahasiswa')
                ->whereRaw('MOD(CAST(nim AS UNSIGNED), 2) = 0')
                ->get();
        } else {
            $mahasiswa = User::where('role', 'mahasiswa')->get();
        }

        $total = $mahasiswa->count();
        $kategori = [
            'berprestasi' => 0,
            'cukup' => 0,
            'kurang' => 0,
        ];

        foreach ($mahasiswa as $mhs) {
            $akademik = Akademik::where('id_user', $mhs->id)->get();

            if ($akademik->isEmpty()) continue;

            $ipk = $akademik->avg('IP');

            if ($ipk > 3.5) {
                $kategori['berprestasi']++;
            } elseif ($ipk > 3.0) {
                $kategori['cukup']++;
            } else {
                $kategori['kurang']++;
            }
        }

        return [
            'total' => $total ?: 1,
            'berprestasi' => $kategori['berprestasi'],
            'cukup' => $kategori['cukup'],
            'kurang' => $kategori['kurang'],
        ];
    }

    public function getGrafikStatistikIpMahasiswa()
    {
        $result = Akademik::select(
            'semester',
            DB::raw('MAX(IP) as ip_max'),
            DB::raw('MIN(IP) as ip_min'),
            DB::raw('AVG(IP) as ip_avg')
        )
            ->groupBy('semester')
            ->orderBy('semester')
            ->get();

        $grafik = $result->map(function ($item) {
            return [
                'semester' => 'smt ' . $item->semester,
                'ip_max' => round($item->ip_max, 2),
                'ip_min' => round($item->ip_min, 2),
                'ip_avg' => round($item->ip_avg, 2),
            ];
        });

        return $grafik;
    }
}
