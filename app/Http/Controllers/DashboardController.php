<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    protected $dosenFilters = [
        '196605171994031003' => 1,
        '198811022022031002' => 0
    ];

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        if ($user->role === 'admin') {
            $query = DB::table('users as u')
                ->leftJoin('akademik_semester as as', 'as.nim', '=', 'u.nim')
                ->select(
                    'u.id',
                    'u.name as user_name',
                    'u.nim',
                    DB::raw('SUM(as.sks) as totalsks'),
                    DB::raw('ROUND(SUM(as.ip) / NULLIF(COUNT(as.semester), 0), 2) as ipk')
                )
                ->where('u.role', 'mahasiswa')
                ->groupBy('u.id', 'u.name', 'u.nim');

            if ($user->nim !== '197511212005012004') {
                if ($user && isset($this->dosenFilters[$user->nim])) {
                    $filterDigit = $this->dosenFilters[$user->nim];
                    $query->whereRaw('MOD(CAST(SUBSTRING(TRIM(u.nim), -1) AS UNSIGNED), 2) = ?', [$filterDigit]);
                }
            }

            $akademik = $query->orderBy('u.id', 'asc')->paginate(10);

            return view('dashboard', [
                'user' => $user,
                'access' => 'admin',
                'akademik' => $akademik
            ]);
        }

        if ($user->role === 'mahasiswa') {
            return view('dashboard', [
                'user' => $user,
                'access' => 'mahasiswa'
            ]);
        }

        if ($user->role === 'superadmin') {
            $admin = User::where('role', 'admin')
            ->select('name', 'nim')
            ->orderBy('nim', 'asc')
            ->get();

            return view('dashboard', compact('admin'));

        }

        abort(403);
    }
}
