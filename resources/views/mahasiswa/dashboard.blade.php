@extends('layouts.appMahasiswa')

@section('content')
    <div class="text-3xl font-semibold mb-12">Dashboard Mahasiswa</div>

    <div class="grid grid-cols-5 grid-rows-3 gap-6 mb-8">

        <div class="col-span-3 rounded-2xl bg-teal-900 text-white shadow-sm py-6 pl-8">
            <div class="text-xl font-semibold text-left mb-4">
                Selamat Datang,
            </div>
            <div class="text-l">
                Yuk pantau dan selalu tingkatkan prestasi akademik Anda melalui SIPRESKOM.
            </div>
        </div>

        @include('components.statusAkademik')

        <div class="col-span-2 row-span-3 col-start-4 bg-white shadow-sm rounded-2xl pt-8 text-left border border-gray-300">
            <div class="text-center mb-6 text-xl font-bold">Profil Saya</div>
            <div class="pl-12 mb-6 pr-10">
                @include('components.profilMahasiswa')
            </div>
            <div class="pl-12">

                <div class="text-md font-bold mb-6">Dosen Pembimbing Akademik:</div>
                <div class="flex gap-5 mb-8 items-center">
                    <div class="overflow-hidden bg-gray-100 rounded-full">
                        <img class="w-20"
                            src="{{ url('storage/images/' . ($user->nim % 2 == 0 ? 'ari.png' : 'pakmul.jpg')) }}"
                            alt="">
                    </div>
                    <div>
                        <div class="font-bold mb-1 text-md">fulan</div>
                        <div class="text-md text-gray-500">NIP. 12345678910</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="grid grid-cols-5 grid-rows-1 gap-6 mb-8">

        <div class="col-span-3 bg-white shadow-sm rounded-2xl border border-gray-300">
            <div class="overflow-x-auto sm:rounded-2xl">
                <tr>
                    <th class="h-24">
                        <div class="py-8 pl-8 bg-white border-gray-300">
                            <div class="flex items-center gap-6 flex-wrap justify-between mx-auto">
                                <div class="text-xl font-bold text-left">Riwayat Akademik</div>
                                <a href="prestasi-akademik"
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
                            <th class="pl-8">Nama Mata Kuliah</th>
                            <th class="pl-4 py-6 pr-3">Kode MK</th>
                            <th class="pl-12 py-6">SKS</th>
                            <th class="pl-16 py-6">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 py-4 font-medium text-gray-900">Pemrograman Web</td>
                            <td class="pl-4 py-6 pr-3">IF101</td>
                            <td class="pl-12 py-6">3</td>
                            <td class="pl-16 py-6">A</td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 py-4 font-medium text-gray-900">Basis Data</td>
                            <td class="pl-4 py-6 pr-3">IF102</td>
                            <td class="pl-12 py-6">3</td>
                            <td class="pl-16 py-6">B+</td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 py-4 font-medium text-gray-900">Jaringan Komputer</td>
                            <td class="pl-4 py-6 pr-3">IF103</td>
                            <td class="pl-12 py-6">3</td>
                            <td class="pl-16 py-6">A-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div
            class="col-span-2 row-span-1 col-start-4 pt-8 bg-white shadow-sm rounded-2xl text-left px-10 border border-gray-300">
            <div class="text-center text-xl font-bold mb-6">Rekomendasi</div>
            <div class="mx-1 grid gap-3">
                <div class="font-bold text-md mt-2">Tingkatkan Konsistensi</div>
                <div class="flex gap-2 content-center text-md font-medium text-gray-800 w-96 items-center">
                    <i class="fa fa-angle-double-right" style="font-size:20px;color:green"></i>
                    Pertahankan nilai A di mata kuliah berikutnya.
                </div>
                <div class="font-bold text-md mt-2">Perbaiki Nilai</div>
                <div class="flex gap-2 content-center text-md font-medium text-gray-800 w-96 items-center">
                    <i class="fa fa-angle-double-right" style="font-size:20px;color:green"></i>
                    Fokus pada mata kuliah dengan nilai B+ untuk meningkatkan IPK.
                </div>
                <div class="font-bold text-md mt-2">Ikuti Pelatihan</div>
                <div class="flex gap-2 content-center text-md font-medium text-gray-800 w-96 items-center">
                    <i class="fa fa-angle-double-right" style="font-size:20px;color:green"></i>
                    Ikuti pelatihan jaringan komputer untuk memperdalam pemahaman.
                </div>
            </div>
        </div>
    </div>
    <div class="h-auto rounded-2xl bg-white shadow-sm border border-gray-300">
        <div class="pt-8 pb-12 text-center text-xl font-bold">Grafik Akademik</div>
        <div class="grid grid-cols-2 gap-6 pb-8 mx-12 items-center">

        <x-ipk-chart :user="$user" :ip-data="[
            ['semester' => 'Semester 1', 'ip' => 3.5],
            ['semester' => 'Semester 2', 'ip' => 3.7],
            ['semester' => 'Semester 3', 'ip' => 3.8],
            ['semester' => 'Semester 4', 'ip' => 3.6],
        ]" :ip-avg-data="[
            ['semester' => 'Semester 1', 'ip' => 3.4],
            ['semester' => 'Semester 2', 'ip' => 3.5],
            ['semester' => 'Semester 3', 'ip' => 3.6],
            ['semester' => 'Semester 4', 'ip' => 3.5],
        ]" />
        <div class="h-fit bg-gray-100 text-black border border-gray-400 rounded-lg p-8 text-left">
            <div class="text-md leading-7">
            Pada <strong>Semester 4</strong>, IP Anda adalah
            <strong>3.6</strong>, yang berada
            <strong>di atas rata-rata</strong> dibandingkan rata-rata IP seluruh mahasiswa yaitu
            <strong>3.5</strong>.
            Tren IP mahasiswa saat ini <strong>menurun</strong> dibandingkan semester
            sebelumnya.
            </div>
        </div>

        </div>
    </div>
    <br><br><br>
@endsection
