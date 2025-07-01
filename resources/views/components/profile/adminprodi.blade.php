<div class="pl-12 mb-6 pr-10">
    <div class="flex items-center">
        <div class="w-32 overflow-hidden bg-gray-100 rounded-full">
            <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/profil.png') }}"
                class="object-cover w-full bg-gray-300 h-full aspect-square">
        </div>
        <div class="ml-8 truncate overflow-hidden text-ellipsis">
            <div class="mb-1 font-semibold text-gray-900">{{ $user->nama }}</div>
            <div class="mb-1 text-sm text-gray-600">{{ $user->nim }}</div>
            <div class="mb-1 text-sm text-gray-600">Administrasi Prodi Ilmu Komputer</div>
            <div class="mb-1 text-sm text-gray-600">{{ $user->email }}</div>
        </div>
    </div>
</div>
<div class="pl-12 pr-10">
    <div class="mb-6 text-sm leading-6 text-ellipsis">
        Admin Program Studi Ilmu Komputer
        Fakultas Matematika dan Ilmu Pengetahuan Alam
        Universitas Negeri Jakarta
    </div>
</div>
