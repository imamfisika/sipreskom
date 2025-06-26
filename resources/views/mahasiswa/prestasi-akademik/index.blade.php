@extends('layouts.app')

@section('title', 'Prestasi Akademik')

@section('content')

    @include('components.sidebar.mahasiswa')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-6">
            Prestasi Akademik
        </div>
        <div class="grid md:grid-cols-3 gap-6 text-center ">
            @include('components.statusAkademik')
        </div>

        <div class="text-2xl w-fit font-semibold mt-10 mb-6">Riwayat Akademik</div>
        <div class="mt-8 border border-gray-300 rounded-2xl">
            <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                <tr>
                    <th>
                        <div class="p-10 bg-white ">
                            <h1 class="text-xl font-semibold text-left">Daftar Mata Kuliah</h1>
                        </div>
                    </th>
                </tr>

                <table class="w-full text-m text-left text-gray-700">
                    <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                        <tr>
                            <th scope="col" class="pl-10">No.</th>
                            <th scope="col" class="pl-2 pr-8">
                                <div class="flex items-center">
                                    Nama Mata Kuliah
                                </div>
                            </th>
                            <th scope="col" class="pr-3">Kode MK</th>
                            <th scope="col" class="pl-10 pr-3">SKS</th>
                            <th scope="col" class="pl-10 py-6">Bobot</th>
                            <th scope="col" class="pl-14 py-6 pr-5">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b border-gray-300">
                            <th scope="row" class="pl-12 font-medium text-gray-900 whitespace-nowrap">1.</th>
                            <td class="pl-3 py-4 font-medium text-gray-900">Matematika</td>
                            <td class="py-4">MK001</td>
                            <td class="pl-12 py-6">3</td>
                            <td class="pl-12 py-6">4.0</td>
                            <td class="pl-16 py-6">A</td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <th scope="row" class="pl-12 font-medium text-gray-900 whitespace-nowrap">2.</th>
                            <td class="pl-3 py-4 font-medium text-gray-900">Fisika</td>
                            <td class="py-4">MK002</td>
                            <td class="pl-12 py-6">3</td>
                            <td class="pl-12 py-6">3.7</td>
                            <td class="pl-16 py-6">A-</td>
                        </tr>
                        {{-- <tr>
                            <td colspan="6" class="p-11 py-4 border-b border-gray-300 bg-gray-100">
                                <!-- Pagination placeholder -->
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
                <div class="bg-white pl-8 pt-8 font-medium text-md">
                    <div class="mb-2">Jumlah SKS Lulus = 6</div>
                    <div class="pb-10">Index Prestasi Kumulatif (IPK) = 3.85</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-10 my-8 rounded-2xl shadow-sm border border-gray-300">
            <div class="text-2xl text-center font-semibold mb-12 ">Grafik Akademik</div>
            <div class="mx-10 my-10">
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
            </div>
            <div class="mx-12 pt-8 py-8 bg-gray-100 text-black border border-gray-400 rounded-lg text-left content-center">
                <div class="text-md mx-8 text-wrap leading-7">
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
    </div>

@endsection
