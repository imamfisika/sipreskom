<?php

namespace App\Service;

use App\Models\User;
use App\Models\Rekomendasi;
use App\Models\Akademik;
use App\Helpers\RekomendasiHelper;
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

    public function getDosenPaByNim($nim)
    {
        $isGenap = ((int) $nim % 2) === 0;

        if ($isGenap) {
            return [
                'nama' => 'Ari Hendarno, S.Pd., M.Kom.	',
                'nip' => '198811022022031002',
                'email' => 'pakari@dsn.unj.ac.id',
                'foto' => 'ari.png',
            ];
        } else {
            return [
                'nama' => 'Drs. Mulyono, M.Kom.	',
                'nip' => '196605171994031003',
                'email' => 'pakmul@dsn.unj.ac.id',
                'foto' => 'pakmul.jpg',
            ];
        }
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
            ->select('nama_dosen', 'keterangan', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('keterangan')
            ->take(3);
    }
    public function getGroupedRekomendasiMahasiswa()
    {
        $mahasiswa = Auth::user();

        $raw = Rekomendasi::with('matkul')
            ->where('id_user', $mahasiswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return RekomendasiHelper::groupRekomendasi($raw);
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

    public function getIpPerSemester($userId)
    {
        return \App\Models\Akademik::where('id_user', $userId)
            ->orderBy('semester')
            ->get(['semester', 'IP'])
            ->map(function ($item) {
                return [
                    'semester' => 'Semester ' . $item->semester,
                    'ip' => $item->IP
                ];
            });
    }

    public function getRataRataIpAngkatanBySemester()
    {
        return \App\Models\Akademik::select('semester', DB::raw('AVG(IP) as rata_ip'))
            ->groupBy('semester')
            ->orderBy('semester')
            ->get()
            ->map(function ($item) {
                return [
                    'semester' => 'Semester ' . $item->semester,
                    'ip' => round($item->rata_ip, 2),
                ];
            });
    }

    public function getGrafikIpMahasiswa($userId)
    {
        $akademiks = \App\Models\Akademik::where('id_user', $userId)
            ->orderBy('semester')
            ->get();

        $ipData = $akademiks->map(function ($item) {
            return [
                'semester' => 'smt ' . $item->semester,
                'ip' => $item->IP,
            ];
        });

        $avgData = \App\Models\Akademik::select('semester', DB::raw('AVG(IP) as ip'))
            ->groupBy('semester')
            ->orderBy('semester')
            ->get()
            ->map(function ($item) {
                return [
                    'semester' => 'Semester ' . $item->semester,
                    'ip' => round($item->ip, 2),
                ];
            });

        $deskripsi = $this->generateDeskripsiIp($ipData, $avgData);

        return compact('ipData', 'avgData', 'deskripsi');
    }
    private function generateDeskripsiIp($ipData, $avgData)
    {
        $last = collect($ipData)->last();
        $prev = collect($ipData)->count() >= 2 ? collect($ipData)->slice(-2, 1)->first() : null;

        $avgLast = collect($avgData)->last();

        if (!$last || !$avgLast) {
            return 'Data IP belum cukup untuk menampilkan analisis.';
        }

        $bandingAvg = $last['ip'] >= $avgLast['ip'] ? 'di atas rata-rata' : 'di bawah rata-rata';
        $tren = ($prev && $last['ip'] < $prev['ip']) ? 'menurun' : 'meningkat';

        return "Pada <strong>{$last['semester']}</strong>, IP Anda adalah <strong>{$last['ip']}</strong>, yang berada <strong>{$bandingAvg}</strong> dibandingkan rata-rata IP seluruh mahasiswa yaitu <strong>{$avgLast['ip']}</strong>. Tren IP Anda saat ini <strong>{$tren}</strong> dibandingkan semester sebelumnya.";
    }
}
