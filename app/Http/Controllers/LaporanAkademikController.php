<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LaporanAkademikController extends Controller
{
    public function index()
    {
        $userNim = Auth::user()->nim;

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

        if ($userNim == '198811022022031002') {
            $query->whereRaw('MOD(u.nim, 2) = 0');
        } elseif ($userNim == '196605171994031003') {
            $query->whereRaw('MOD(u.nim, 2) = 1');
        }

        $akademik = $query->orderBy('ipk', 'desc')->orderBy('totalsks', 'desc')->paginate(10);

        return view('laporanAkademik', compact('akademik'));
    }
    public function unduh()
    {
        $userNim = Auth::user()->nim;

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

        if ($userNim == '198811022022031002') {
            $query->whereRaw('MOD(u.nim, 2) = 0');
        } elseif ($userNim == '196605171994031003') {
            $query->whereRaw('MOD(u.nim, 2) = 1');
        }

        $akademik = $query->orderBy('ipk', 'desc')->orderBy('totalsks', 'desc')->get();

        $pdf = Pdf::loadView('laporanAkademik_pdf', compact('akademik'));
        return $pdf->download('laporanAkademik.pdf');
    }

    public function cetakPDF()
    {
        $akademik = DB::table('users as u')
            ->leftJoin('akademik_semester as a', 'a.nim', '=', 'u.nim')
            ->select('u.id', 'u.name as user_name', 'u.nim')
            ->selectRaw('SUM(COALESCE(a.sks, 0)) as totalsks')
            ->selectRaw('ROUND(SUM(CASE WHEN a.ip > 0 THEN a.ip ELSE 0 END) / NULLIF(COUNT(CASE WHEN a.ip > 0 THEN 1 ELSE NULL END), 0), 2) as ipk')
            ->where('u.role', 'mahasiswa')
            ->groupBy('u.id', 'u.name', 'u.nim')
            ->orderBy('u.id', 'asc')
            ->get();

        $pdf = Pdf::loadView('laporanAkademik_pdf', compact('akademik'));

        return $pdf->stream('laporanAkademik.pdf');
    }
}
