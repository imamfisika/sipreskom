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
<div class="flex items-center">
    <div class="w-32 overflow-hidden bg-gray-100 rounded-full">
        <img src="{{ asset('images/profil.png') }}" class="object-cover w-full bg-gray-300 h-full aspect-square">
    </div>
    <div class="ml-8 gap-6 leading-7 truncate overflow-hidden text-ellipsis">
        <div class="font-bold text-gray-900">Fulan Fulanah</div>
        <div class="text-gray-500">NIM. 123456789</div>
        <div class="text-gray-500">Ilmu Komputer 2020</div>
        <div class="text-gray-500">fulanf@gmail.com</div>
    </div>
</div>
