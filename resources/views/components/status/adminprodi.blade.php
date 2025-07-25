<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-10 border border-gray-300">
    <div class="w-14 h-14 bg-emerald-500 rounded-lg flex items-center justify-center mb-10">
        <i class="fa fa-file-text" style="font-size:24px; color:white"></i>
    </div>
    <div class="flex justify-between items-center">
        <div class="text-lg font-semibold mr-3">Mata Kuliah</div>
        <div class="text-xl text-emerald-500 font-bold">{{ $status['matkul'] }}</div>
    </div>
</div>
<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-sky-500 rounded-lg flex items-center justify-center mb-10">
        <i class="fa fa-graduation-cap" style="font-size:24px; color:white"></i>
    </div>
    <div class="flex justify-between items-center">
        <div class="text-lg font-semibold w-12">Pembimbing Akademik</div>
        <div class="text-xl text-sky-500 font-bold">{{ $status['dosenpa'] }}</div>
    </div>
</div>
<div
    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
    <div class="w-14 h-14 bg-indigo-500 rounded-lg flex items-center justify-center mb-10">
        <i class="fa fa-graduation-cap" style="font-size:24px; color:white"></i>
    </div>
    <div class="flex justify-between items-center">
        <div class="text-lg font-semibold mr-3">Mahasiswa</div>
        <div class="text-xl text-indigo-500 font-bold">{{ $status['mahasiswa'] }}</div>
    </div>
</div>
