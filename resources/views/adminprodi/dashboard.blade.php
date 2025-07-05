@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @include('components.sidebar.adminprodi')

    <div class="text-3xl font-bold mb-12">Dashboard Admin</div>
    <div class="grid grid-cols-5 grid-rows-3 gap-6 mb-6">
        <div class="col-span-3 rounded-2xl bg-teal-900 text-white shadow-sm py-6 pl-8">
            <div class="text-xl font-semibold text-left mb-3">
                Selamat Datang, Admin Program Studi
            </div>
            <div class="text-sm">
                Kelola pengguna dan pantau perkembangan prestasi akademik mahasiswa melalui SIPRESKOM.
            </div>
        </div>

        @include('components.status.adminprodi')

        <div class="col-span-2 row-span-3 col-start-4 bg-white shadow-sm rounded-2xl pt-8 text-left border border-gray-300">
            <div class="text-center mb-6 text-lg font-bold">Profil Saya
            </div>
            @include('components.profile.adminprodi')
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6 mt-6">
        <div class="bg-white shadow-sm rounded-2xl border border-gray-300">
            <div class="py-10 px-10 bg-white border-b border-gray-300 rounded-t-2xl">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="text-lg font-bold text-left">Daftar Dosen Pembimbing Akademik</div>
                    <a href="{{ route('adminprodi.kelola-pengguna.view', ['role' => 'dosen']) }}"
                        class="transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full text-sm px-4 py-2">
                        Lihat semua
                    </a>
                </div>
            </div>
            <div class="overflow-hidden sm:rounded-b-2xl">
                <table class="w-full text-sm text-left text-gray-700 table-fixed">
                    <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                        <tr>
                            <th class="w-12 px-8 py-4">No.</th>
                            <th class="w-54 px-4 py-4">Nama Dosen</th>
                            <th class="w-54 px-4 py-4">NIP</th>
                            <th class="w-48 px-4 py-4">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dosenpa->take(5) as $index => $dsn)
                            <tr class="bg-white border-b border-gray-300">
                                <td class="px-8 py-4">{{ $index + 1 }}.</td>
                                <td class="px-4 py-4 truncate font-medium text-black">{{ $dsn->nama }}</td>
                                <td class="px-4 py-4 truncate">{{ $dsn->nim }}</td>
                                <td class="px-4 py-4 truncate overflow-hidden whitespace-nowrap">{{ $dsn->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">Tidak ada data dosen pembimbing.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-2xl border border-gray-300">
            <div class="py-10 px-10 bg-white border-b border-gray-300 rounded-t-2xl">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="text-lg font-bold text-left">Daftar Mahasiswa</div>
                    <a href="{{ route('adminprodi.kelola-pengguna.view', ['role' => 'mahasiswa']) }}"
                        class="transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full text-sm px-4 py-2">
                        Lihat semua
                    </a>
                </div>
            </div>
            <div class="overflow-hidden sm:rounded-b-2xl">
                <table class="w-full text-sm text-left text-gray-700 table-fixed">
                    <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                        <tr>
                            <th class="w-12 px-8 py-4">No.</th>
                            <th class="w-54 px-4 py-4">Nama Mahasiswa</th>
                            <th class="w-54 px-4 py-4">NIM</th>
                            <th class="w-48 px-4 py-4">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswa as $index => $mhs)
                            <tr class="bg-white border-b border-gray-300">
                                <td class="px-8 py-4">{{ $index + 1 }}.</td>
                                <td class="px-4 py-4 truncate font-medium text-black">{{ $mhs->nama }}</td>
                                <td class="px-4 py-4 truncate">{{ $mhs->nim }}</td>
                                <td class="px-4 py-4 truncate overflow-hidden whitespace-nowrap">{{ $mhs->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">Tidak ada data mahasiswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
