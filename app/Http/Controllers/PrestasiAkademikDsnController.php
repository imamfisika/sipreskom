<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Rekomendasi;
use App\Models\User;

class PrestasiAkademikDsnController extends Controller
{
    protected $dosenFilters = [
        '196605171994031003' => 1,
        '198811022022031002' => 0,
        '197511212005012004' => 'all'
    ];

    public function index($nim)
    {
        $user = Auth::user();
        if (!$user || !$user->nim || !$user->role) {
            return redirect()->route('login')->with('error', 'User not authenticated');
        }

        $loggedInUser = $user;
        $filterByLastDigit = $this->dosenFilters[$loggedInUser->nim] ?? null;

        $jumlahMahasiswa = null;
        if ($filterByLastDigit === 'all') {
            $jumlahMahasiswa = DB::table('users')
                ->where('role', 'mahasiswa')
                ->count();
        } elseif (!is_null($filterByLastDigit)) {
            $jumlahMahasiswa = DB::table('users')
                ->where('role', 'mahasiswa')
                ->whereRaw('CAST(RIGHT(nim, 1) AS UNSIGNED) % 2 = ?', [$filterByLastDigit])
                ->count();
        }

        $mahasiswa = DB::connection('sipreskom')->table('users')
            ->select('nim', 'name as nama_mahasiswa', 'foto', 'email')
            ->where('nim', $nim)
            ->firstOrFail();

        $akademikSemesters = DB::connection('sipreskom')->table('akademik_semester')
            ->where('nim', $nim)
            ->get();

        $totalsks = $akademikSemesters->sum('sks');

        $ipValues = $akademikSemesters->pluck('ip')->filter(fn($ip) => $ip > 0);

        $ipk = $ipValues->isNotEmpty() ? round($ipValues->avg(), 2) : 0;

        $mahasiswa->totalsks = $totalsks;
        $mahasiswa->ipk = $ipk;

        $mataKuliah = DB::connection('sipreskom')->table('nilai')
            ->join('matkul', 'nilai.kode_matkul', '=', 'matkul.kode_matkul')
            ->where('nilai.nim', $nim)
            ->select('nilai.kode_matkul', 'nilai.nilai', 'nilai.bobot', 'matkul.nama_matkul', 'matkul.sks')
            ->paginate(10);

            $rekomendasis = Rekomendasi::where('nim', $nim)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(fn($item) => $item->created_at->format('Y-m-d H:i:s'));

        return view('prestasiDsn', [
            'mahasiswa' => $mahasiswa,
            'mataKuliah' => $mataKuliah,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'rekomendasis' => $rekomendasis
        ]);
    }
    public function showChart()
    {
        $mahasiswaNims = User::where('role', 'mahasiswa')->pluck('nim')->toArray();

        $allAkademik = DB::table('akademik_semester')
            ->whereIn('nim', $mahasiswaNims)
            ->get()
            ->groupBy('semester');

        $ipAvgData = [];
        $ipMaxData = [];
        $ipMinData = [];

        for ($i = 1; $i <= 14; $i++) {
            if (isset($allAkademik[$i])) {
                $values = $allAkademik[$i]->pluck('ip')->filter(fn($v) => $v > 0)->values();

                if ($values->count() > 0) {
                    $avg = round($values->avg(), 2);
                    $max = $values->max();
                    $min = $values->min();

                    $ipAvgData[] = ['semester' => "Semester $i", 'ip' => $avg];
                    $ipMaxData[] = ['semester' => "Semester $i", 'ip' => $max];
                    $ipMinData[] = ['semester' => "Semester $i", 'ip' => $min];
                }
            }
        }


        return view('prestasiDsn', compact('ipData', 'predictedIp', 'nextSemester'));
    }
}
