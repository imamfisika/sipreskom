<?php

// namespace App\Http\Controllers;

// use App\Helpers\IPKPredictor;
// use Illuminate\Http\Request;
// use App\Models\Rekomendasi;
// use App\Models\User;
// use App\Models\Matkul;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

// class RekomendasiController extends Controller
// {
//     protected $dosenFilters = [
//         '196605171994031003' => 1,
//         '198811022022031002' => 0,
//     ];

//     public function create()
//     {
//         $matakuliahs = Matkul::all();
//         $user = Auth::user();
//         $query = User::where('role', 'mahasiswa');

//         if ($user && $user->nim && isset($this->dosenFilters[$user->nim])) {
//             $filterDigit = $this->dosenFilters[$user->nim];
//             $query->whereRaw('CAST(SUBSTRING(nim, -1) AS UNSIGNED) % 2 = ?', [$filterDigit]);
//         }

//         $mahasiswas = $query->get(['nim', 'name']);

//         return view('tambahRekomendasi', compact('matakuliahs', 'mahasiswas'));
//     }

//     public function store(Request $request)
//     {
//         if (Auth::user()->role !== 'admin') {
//             abort(403, 'Unauthorized');
//         }

//         $request->validate([
//             'name' => 'required',
//             'nim' => 'required',
//             'matkul_rekomendasi' => 'required|array|min:2',
//             'isi' => 'required|string',
//         ]);

//         foreach ($request->matkul_rekomendasi as $matkul) {
//             Rekomendasi::create([
//                 'name' => $request->name,
//                 'nim' => $request->nim,
//                 'matkul_rekomendasi' => $matkul,
//                 'isi' => $request->isi,
//             ]);
//         }

//         return redirect()->route('rekomendasi')->with('success', 'Rekomendasi berhasil ditambahkan');
//     }

//     public function index()
//     {
//         $user = Auth::user();

//         if (!$user || !$user->nim || !$user->role) {
//             return redirect()->route('login')->with('error', 'User not authenticated');
//         }

//         if ($user->name === 'Ria Arafiyah , S.Si. M.Si.') {
//             $query = Rekomendasi::join('users as mhs', 'rekomendasis.nim', '=', 'mhs.nim')
//                 ->select('rekomendasis.*', 'mhs.name as mahasiswa_name');
//         } elseif (isset($this->dosenFilters[$user->nim])) {
//             $filterDigit = $this->dosenFilters[$user->nim];
//             $query = Rekomendasi::join('users', 'rekomendasis.nim', '=', 'users.nim')
//                 ->select('rekomendasis.*', 'users.name as mahasiswa_name')
//                 ->whereRaw('CAST(SUBSTRING(rekomendasis.nim, -1) AS UNSIGNED) % 2 = ?', [$filterDigit])
//                 ->where('rekomendasis.name', $user->name);
//         } else {
//             $query = Rekomendasi::where('rekomendasis.nim', $user->nim)
//                 ->join('users', 'rekomendasis.nim', '=', 'users.nim')
//                 ->select('rekomendasis.*', 'users.name as mahasiswa_name');
//         }

//         $rekomendasis = $query->orderBy('rekomendasis.created_at', 'desc')
//             ->get()
//             ->groupBy(fn($item) => $item->created_at->format('Y-m-d H:i:s'));

//         $ipData = [];
//         $predictedIpBayes = null;
//         $prediksiKategori = null;

//         if ($user->role === 'mahasiswa') {
//             $dataSemester = DB::table('akademik_semester')
//                 ->where('nim', $user->nim)
//                 ->orderBy('semester')
//                 ->get();

//             $allSemester = DB::table('akademik_semester')
//                 ->orderBy('nim')
//                 ->orderBy('semester')
//                 ->get()
//                 ->groupBy('nim');

//             $trainData = [];
//             $trainTargets = [];

//             foreach ($allSemester as $nim => $records) {
//                 $records = $records->sortBy('semester')->values();
//                 if ($records->count() < 2) continue;

//                 $features = $records->slice(0, -1)->pluck('ip')->toArray();
//                 $target = $records->last()->ip;

//                 if (!in_array(0, $features) && $target > 0) {
//                     $trainData[] = $features;
//                     $trainTargets[] = $target;
//                 }
//             }

//             $inputFeatures = $dataSemester->pluck('ip')->slice(0, -1)->values()->toArray();

//             if (count($inputFeatures) > 0 && count($trainData) > 0) {
//                 $nb = new IPKPredictor();
//                 $nb->train($trainData, $trainTargets);
//                 $predictedIpBayes = $nb->predict($inputFeatures);

//                 if ($predictedIpBayes !== null) {
//                     if ($predictedIpBayes > 3.5) {
//                         $prediksiKategori = 'Berprestasi';
//                     } elseif ($predictedIpBayes >= 3.01) {
//                         $prediksiKategori = 'Cukup Berprestasi';
//                     } else {
//                         $prediksiKategori = 'Kurang Berprestasi';
//                     }
//                 }
//             }

//             foreach ($dataSemester as $record) {
//                 if ($record->ip > 0) {
//                     $ipData[] = [
//                         'semester' => 'Semester ' . $record->semester,
//                         'ip' => $record->ip,
//                     ];
//                 }
//             }

//             $totalIp = $dataSemester->sum('ip');
//             $totalSks = $dataSemester->sum('sks');
//             $jumlahSemester = $dataSemester->count();

//             $ipk = $jumlahSemester > 0 ? round($totalIp / $jumlahSemester, 2) : null;
//             $nextSemester = $jumlahSemester + 1;
//             $predictedIp = $predictedIpBayes;
//         } else {
//             $allSemester = DB::table('akademik_semester')->get()->groupBy('semester');

//             foreach ($allSemester as $semester => $records) {
//                 $ips = collect($records)->pluck('ip')->filter(fn($ip) => $ip > 0);
//                 if ($ips->isNotEmpty()) {
//                     $avg = round($ips->avg(), 2);
//                     $ipData[] = [
//                         'semester' => "Semester $semester",
//                         'ip' => $avg,
//                     ];
//                 }
//             }

//             $nextSemester = count($ipData) + 1;
//             $ipk = null;
//             $totalSks = null;
//             $predictedIp = null;
//         }

//         $ulangMatkul = [];

//         if ($user->role === 'mahasiswa') {
//             $nilaiMahasiswa = DB::table('nilai')
//                 ->where('nim', $user->nim)
//                 ->join('matkul', 'nilai.kode_matkul', '=', 'matkul.kode_matkul')
//                 ->select('nilai.nilai', 'nilai.kode_matkul', 'matkul.nama_matkul')
//                 ->get();

//             $nilaiGagal = ['C-', 'D', 'E'];

//             foreach ($nilaiMahasiswa as $item) {
//                 if (in_array($item->nilai, $nilaiGagal)) {
//                     $ulangMatkul[] = [
//                         'kode_matkul' => $item->kode_matkul,
//                         'nama_matkul' => $item->nama_matkul,
//                         'nilai' => $item->nilai,
//                         'status' => 'Wajib Diulang',
//                     ];
//                 } elseif ($item->nilai === 'C') {
//                     $ulangMatkul[] = [
//                         'kode_matkul' => $item->kode_matkul,
//                         'nama_matkul' => $item->nama_matkul,
//                         'nilai' => $item->nilai,
//                         'status' => 'Boleh Diulang (Opsional)',
//                     ];
//                 }
//             }

//             $ulangMatkul = collect($ulangMatkul)->sortByDesc(function ($item) {
//                 return $item['status'] === 'Wajib Diulang' ? 1 : 0;
//             })->values()->all();
//         }

//         return view('rekomendasi', compact(
//             'rekomendasis',
//             'ipData',
//             'predictedIp',
//             'nextSemester',
//             'ulangMatkul',
//             'predictedIpBayes',
//             'prediksiKategori'
//         ));
//     }
}
