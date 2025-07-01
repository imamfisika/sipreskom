@php
    $total = $statusData['total'] ?: 1;
@endphp

<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-emerald-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-graduation-cap" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-semibold mb-5">Berprestasi</div>
    <div class="flex justify-between items-center gap-4 mb-3">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-emerald-500 h-4 rounded-full" style="width: {{ ($statusData['berprestasi'] / $total) * 100 }}%">
            </div>
        </div>
    </div>
    <div class="text-sm flex">{{ $statusData['berprestasi'] }} &nbsp
        <div class="font-bold text-emerald-500">/&nbsp {{ $total }}</div>
    </div>
</div>
<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-sky-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-graduation-cap" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-semibold mb-5">Cukup Berprestasi</div>
    <div class="flex justify-between items-center gap-4 mb-3">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-sky-500 h-4 rounded-full" style="width: {{ ($statusData['cukup'] / $total) * 100 }}%">
            </div>
        </div>
    </div>
    <div class="text-sm flex"> {{ $statusData['cukup'] }}  &nbsp
        <div class="font-bold text-sky-500">/&nbsp {{ $total }}</div>
    </div>
</div>
<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-indigo-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-graduation-cap" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-semibold mb-5">Kurang Berprestasi</div>
    <div class="flex justify-between items-center gap-4 mb-3">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-indigo-500 h-4 rounded-full" style="width: {{ ($statusData['kurang'] / $total) * 100 }}%"></div>
        </div>
    </div>
    <div class="text-sm flex"> {{ $statusData['kurang'] }}  &nbsp
        <div class="font-bold text-indigo-500">/&nbsp {{ $total }}</div>
    </div>
</div>
