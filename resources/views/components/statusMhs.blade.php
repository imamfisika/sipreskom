@php
    $loggedInNim = auth()->user()->nim;

    $query = DB::table('akademik_semester')
        ->select('nim', DB::raw('SUM(sks) as totalsks'), DB::raw('SUM(ip) as totalip'), DB::raw('MAX(semester) as last_semester'))
        ->groupBy('nim');

    if ($loggedInNim == '196605171994031003') {
        $query->whereRaw('nim % 2 != 0');
    } elseif ($loggedInNim == '198811022022031002') {
        $query->whereRaw('nim % 2 = 0');
    }

    $data = $query->get();
    $totalCount = $data->count();

    $prestasiCount = $data->filter(function ($item) {
        $ipk = $item->last_semester > 0 ? round($item->totalip / $item->last_semester, 2) : 0;
        return $ipk > 3.50;
    })->count();

    $cukupPrestasiCount = $data->filter(function ($item) {
        $ipk = $item->last_semester > 0 ? round($item->totalip / $item->last_semester, 2) : 0;
        return $ipk >= 3.00 && $ipk <= 3.51;
    })->count();

    $kurangPrestasiCount = $data->filter(function ($item) {
        $ipk = $item->last_semester > 0 ? round($item->totalip / $item->last_semester, 2) : 0;
        return $ipk < 3.01;
    })->count();
@endphp


<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-emerald-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-graduation-cap" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-bold mb-5">Berprestasi</div>
    <div class="flex justify-between items-center gap-4 mb-3">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-emerald-500 h-4 rounded-full" style="width:  {{ ($prestasiCount / $totalCount) * 100 }}%">
            </div>
        </div>
    </div>
    <div class="text-sm font-semibold flex">{{ $prestasiCount }} &nbsp
        <div class="font-black text-emerald-500">/&nbsp {{ $totalCount }}</div>
    </div>

</div>
<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-sky-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-graduation-cap" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-bold mb-5">Cukup Berprestasi</div>
    <div class="flex justify-between items-center gap-4 mb-3">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-sky-500 h-4 rounded-full" style="width:  {{ ($cukupPrestasiCount / $totalCount) * 100 }}%">
            </div>
        </div>
    </div>
    <div class="text-sm font-semibold flex">{{ $cukupPrestasiCount }} &nbsp
        <div class="font-black text-sky-500">/&nbsp {{ $totalCount }}</div>
    </div>
</div>
<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-indigo-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-graduation-cap" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-bold mb-5">Kurang Berprestasi</div>
    <div class="flex justify-between items-center gap-4 mb-3">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-indigo-500 h-4 rounded-full"
                style="width: {{ ($kurangPrestasiCount / $totalCount) * 100 }}%"></div>
        </div>
    </div>
    <div class="text-sm font-semibold flex">{{ $kurangPrestasiCount }} &nbsp
        <div class="font-black text-indigo-500">/&nbsp {{ $totalCount }}</div>
    </div>
</div>
