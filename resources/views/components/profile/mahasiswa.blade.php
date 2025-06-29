{{-- <div class="flex items-center">
    <div class="w-32 overflow-hidden bg-gray-100 rounded-full">
        <img src="{{ $user->foto_url }}" class="object-cover w-full h-full aspect-square">
    </div>
    <div class="ml-6 leading-7 truncate overflow-hidden text-ellipsis">
        <div class="font-bold text-gray-900">{{ $user->name }}</div>
        <div class="text-gray-500">{{ $user->nim }}</div>
        @if (Auth::user()->role !== 'admin')
            <div class="text-gray-500">Ilmu Komputer 20{{ substr($user->nim, 5, 2) }}</div>
        @endif
        <div class="text-gray-500">{{ $user->email }}</div>
    </div>
</div> --}}
<div class="pl-12 mb-6 pr-10">
    <div class="flex items-center">
        <div class="w-32 overflow-hidden bg-gray-100 rounded-full">
            <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/profil.png') }}"
                class="object-cover w-full bg-gray-300 h-full aspect-square">
        </div>
        <div class="ml-8 truncate overflow-hidden text-ellipsis">
            <div class="mb-1 font-semibold text-gray-900">{{ $user->nama }}</div>
            <div class="mb-1 text-sm text-gray-600">{{ $user->nim }}</div>
            <div class="mb-1 text-sm text-gray-600">Ilmu Komputer {{ '20' . substr($user->nim, 5, 2) }}</div>
            <div class="mb-1 text-sm text-gray-600 truncate">{{ $user->email }}</div>
        </div>
    </div>
</div>

@if (!isset($hideDosenPa))
    <div class="pl-12">
        <div class="text-md font-semibold mb-6">Dosen Pembimbing Akademik:</div>
        <div class="flex gap-5 mb-8 items-center">
            <div class="overflow-hidden bg-gray-100 rounded-full">
                <img class="w-20" src="{{ url('storage/images/' . ($user->nim % 2 == 0 ? 'ari.png' : 'pakmul.jpg')) }}"
                    alt="">
            </div>
            <div>
                <div class="mb-1 font-semibold text-gray-900">fulan</div>
                <div class="mb-1 text-sm text-gray-600">NIP. 12345678910</div>
                <div class="mb-1 text-sm text-gray-600">fulan@gmail.com</div>
            </div>
        </div>
    </div>
@endif
