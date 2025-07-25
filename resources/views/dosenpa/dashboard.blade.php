@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('components.sidebar.dosenpa')

    <div class="text-3xl font-bold mb-12">Dashboard Dosen</div>

    <div class="grid grid-cols-5 grid-rows-3 gap-6 mb-8">

        <div class="col-span-3 rounded-2xl bg-teal-900 text-white shadow-sm py-6 pl-8">
            <div class="text-xl font-semibold text-left mb-3">
                Selamat Datang, Bapak/Ibu Dosen
            </div>
            <div class="text-sm">
                Pantau dan tingkatkan prestasi akademik Mahasiswa Ilmu Komputer melalui SIPRESKOM.
            </div>
        </div>

        @include('components.status.dosenpa', ['statusData' => $statusData])

        <div class="col-span-2 row-span-3 col-start-4 bg-white shadow-sm rounded-2xl pt-8 text-left border border-gray-300">
            <div class="text-center mb-6 text-lg font-bold">Profil Saya</div>
            @include('components.profile.dosenpa')
        </div>
    </div>

    <div class="grid grid-cols-5 grid-rows-1 gap-6 mb-8">
        <div class="col-span-3 bg-white shadow-sm rounded-2xl border border-gray-300">
            <div class="overflow-x-auto sm:rounded-2xl">
                <div class="p-10 bg-white border-b border-gray-300 rounded-t-2xl">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="text-lg font-bold text-left">Mahasiswa Bimbingan Akademik</div>
                        <a href="{{ route('dosenpa.prestasi-akademik.index') }}"
                            class="transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full text-sm px-4 py-2">
                            Lihat semua
                        </a>
                    </div>
                </div>
        
                <table class="w-full text-sm text-left bg-teal-900 border-collapse">
                    <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                        <tr>
                            <th class="pl-12">Nama Mahasiswa</th>
                            <th class="pl-12 pr-6">NIM</th>
                            <th class="px-8 py-4 text-center">Total SKS</th>
                            <th class="px-8">IPK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswa as $mhs)
                            <tr class="bg-white border-b border-gray-300">
                                <td class="pl-12 font-medium text-gray-900">{{ $mhs['nama'] }}</td>
                                <td class="pl-12 pr-6">{{ $mhs['nim'] }}</td>
                                <td class="px-8 py-4 text-center">{{ $mhs['total_sks'] }}</td>
                                <td class="px-8">{{ $mhs['ipk'] }}</td>
                            </tr>
                        @empty
                            <tr class="bg-white">
                                <td colspan="4" class="text-center py-8 text-gray-500">Belum ada data mahasiswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-span-2 row-span-1 col-start-4 pt-8 bg-white shadow-sm rounded-2xl text-left border border-gray-300">
            <div class="pb-2 text-center text-lg font-bold">Grafik Akademik Angkatan</div>
            @include('components.grafik.dosenpa', ['grafik' => $grafik])
        </div>
    </div>
@endsection
