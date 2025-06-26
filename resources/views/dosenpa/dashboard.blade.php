@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="text-3xl font-bold mb-12">Dashboard Dosen</div>

    <div class="grid grid-cols-5 grid-rows-3 gap-6 mb-8">

        <div class="col-span-3 rounded-2xl bg-teal-900 text-white shadow-sm py-6 pl-8">
            <div class="text-xl font-semibold text-left mb-4">
                Selamat Datang, Bapak/Ibu Dosen
            </div>
            <div class="text-normal">
                Pantau dan tingkatkan prestasi akademik Mahasiswa Ilmu Komputer melalui SIPRESKOM.
            </div>
        </div>

        @include('components.statusPrestasiMahasiswa')

        <div class="col-span-2 row-span-3 col-start-4 bg-white shadow-sm rounded-2xl pt-8 text-left border border-gray-300">
            <div class="text-center mb-6 text-xl font-bold">Profil Saya</div>
            <div class="pl-12 mb-6 pr-10">
                @include('components.profile.dosenpa')
            </div>
            <div class="px-12">
                <div class="mb-6 font-normal leading-7 text-ellipsis">
                    Dosen Pembimbing Akademik Mahasiswa Program Studi Ilmu Komputer
                    Fakultas Matematika dan Pengetahuan Alam
                    Universitas Negeri Jakarta
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-5 grid-rows-1 gap-6 mb-8">

        <div class="col-span-3 bg-white shadow-sm rounded-2xl border border-gray-300">
            <div class="overflow-x-auto sm:rounded-2xl">
                <tr>
                    <th class="h-24">
                        <div class="py-10 pl-8 bg-white border-gray-300">
                            <div class="flex items-center gap-6 flex-wrap justify-between mx-auto">
                                <div class="text-xl font-bold text-left">Mahasiswa Bimbingan Akademik</div>
                                <a href="#"
                                    class="transition ease-in-out duration-150 hover:bg-teal-800 text-white mr-8 bg-teal-700 font-bold rounded-full text-sm px-4 py-2 mb-1">
                                    Lihat semua
                                </a>
                            </div>
                        </div>
                    </th>
                </tr>

                <table class="w-full text-md text-left bg-teal-900 border-collapse">
                    <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                        <tr>
                            <th class="pl-8">Nama Lengkap</th>
                            <th class="pl-12 pr-6">NIM</th>
                            <th class="pl-8 py-6">Total SKS</th>
                            <th class="pl-8 pr-4">IPK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 font-medium text-gray-900">John Doe</td>
                            <td class="pl-12 pr-6">123456789</td>
                            <td class="pl-16 py-6 ">120</td>
                            <td class="pl-8 pr-4">3.75</td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 font-medium text-gray-900">Jane Smith</td>
                            <td class="pl-12 pr-6">987654321</td>
                            <td class="pl-16 py-6 ">110</td>
                            <td class="pl-8 pr-4">3.60</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div
            class="col-span-2 row-span-1 col-start-4 pt-8 bg-white shadow-sm rounded-2xl text-left pl-12 pr-10 border border-gray-300">
            <div class="text-center mb-6 text-xl font-bold">Grafik Akademik Angkatan</div>
            <div class="my-8">
                <x-chart-dsn :ip-avg-data="[
                    ['semester' => 'Semester 1', 'ip' => 3.5],
                    ['semester' => 'Semester 2', 'ip' => 3.6],
                    ['semester' => 'Semester 3', 'ip' => 3.7],
                ]" :ip-max-data="[
                    ['semester' => 'Semester 1', 'ip' => 4.0],
                    ['semester' => 'Semester 2', 'ip' => 3.9],
                    ['semester' => 'Semester 3', 'ip' => 3.8],
                ]" :ip-min-data="[
                    ['semester' => 'Semester 1', 'ip' => 3.0],
                    ['semester' => 'Semester 2', 'ip' => 3.2],
                    ['semester' => 'Semester 3', 'ip' => 3.4],
                ]" />
            </div>
            <div class="mx-4 my-8 py-6 bg-gray-100 text-black border border-gray-400 rounded-lg text-left content-center">
                <div class="text-md leading-7rounded-lg px-6 py-2">
                    Pada <strong>Semester 3</strong>, IP rata-rata mahasiswa adalah
                    <strong>3.7</strong>. Nilai IP tertinggi mencapai
                    <strong>3.8</strong>, sedangkan IP terendah adalah
                    <strong>3.4</strong>. Tren rata-rata IP mahasiswa
                    <strong>meningkat</strong> dibandingkan semester sebelumnya.
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
