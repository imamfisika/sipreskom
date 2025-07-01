<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300 w-full">
    <div class="w-14 h-14 bg-emerald-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-file-text" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-semibold mb-5">Total SKS</div>
    <div class="flex justify-between items-center gap-4 mb-3">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-emerald-500 h-4 rounded-full" style="width:{{ min(($ipksks['total_sks'] / 144) * 100, 100) }}%">
            </div>
        </div>
    </div>
    <div class="text-sm flex">
        <div>
            {{ $ipksks['total_sks'] ?? '-' }}
            &nbsp
        </div>
        <div class="font-bold text-emerald-500">/&nbsp 144</div>
    </div>
</div>
<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300 w-full">
    <div class="w-14 h-14 bg-sky-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-bar-chart" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-semibold mb-5">IPK</div>
    <div class="flex justify-between items-center gap-4 mb-3">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-sky-500 h-4 rounded-full" style="width: {{ ($ipksks['ipk'] / 4.0) * 100 }}%">
            </div>
        </div>
    </div>
    <div class="text-sm flex">
        <div>
            {{ $ipksks['ipk'] ?? '-' }}
            &nbsp
        </div>
        <div class="font-bold text-sky-500">/&nbsp 4.00</div>
    </div>
</div>
<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300 w-full">
    <div class="w-14 h-14 bg-indigo-500 rounded-lg flex items-center justify-center mb-8">
        <i class="fa fa-mortar-board" style="font-size:24px; color:white"></i>
    </div>
    <div class="text-lg font-semibold mb-5">Status Akademik</div>
    <div class="w-max text-lg text-indigo-500 font-bold mb-6">Berprestasi</div>
</div>
