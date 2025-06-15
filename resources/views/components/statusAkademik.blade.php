@php
    $user = Auth::user();

    $semesterData = DB::table('akademik_semester')
        ->where('nim', $user->nim)
        ->get(['sks', 'ip', 'semester']);

    $totalsks = $semesterData->sum('sks');

    $totalIp = $semesterData->sum('ip');
    $semesterTerakhir = $semesterData->max('semester');

    $ipk = $semesterTerakhir > 0 ? round($totalIp / $semesterTerakhir, 2) : null;
@endphp

<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-emerald-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-file-text" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-bold mb-5">SKS Lulus</div>
    <div class="flex justify-between items-center gap-4 mb-3">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-emerald-500 h-4 rounded-full" style="width:{{ min(($totalsks / 144) * 100, 100) }}%">
            </div>
        </div>
    </div>
    <div class="text-sm font-semibold flex">
        <div>
            {{ $totalsks }}
            &nbsp
        </div>
        <div class="font-black text-emerald-500">/&nbsp 144</div>
    </div>
</div>
<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-sky-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-bar-chart" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-bold mb-5">IPK</div>
    <div class="flex justify-between items-center gap-4 mb-3">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-sky-500 h-4 rounded-full" style="width: {{ ($ipk / 4.0) * 100 }}%">
            </div>
        </div>
    </div>
    <div class="text-sm font-semibold flex">
        <div>
            {{ $ipk }}
            &nbsp
        </div>
        <div class="font-black text-sky-500">/&nbsp 4.00</div>
    </div>
</div>
<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-indigo-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-mortar-board" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-bold mb-5">Status Akademik</div>
    @php
        $status = '';
        if ($ipk > 3.5) {
            $status = 'Berprestasi';
        } elseif ($ipk >= 3.01 && $ipk <= 3.5) {
            $status = 'Cukup Berprestasi';
        } else {
            $status = 'Kurang Berprestasi';
        }
    @endphp
    <div class="text-lg text-indigo-500 font-bold mb-6">{{ $status }}
    </div>

</div>
