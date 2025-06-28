@extends('layouts.app')

@section('title', 'Prestasi Akademik')

@section('content')
    @include('components.sidebar.dosenpa')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-6">Prestasi Akademik</div>

        <div class="col-span-2 row-span-2 mb-8">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center">
                @include('components.statusPrestasiMahasiswa')
            </div>
        </div>

        <hr class="h-px my-12 bg-gray-300 border-0">

        <div class="flex items-center justify-between">
            <div class="flex gap-4 items-center">
                <div class="text-md font-semibold">Angkatan:</div>
                <button
                    class="flex-wrap justify-between mx-auto text-black bg-white border border-gray-300 w-96 rounded-lg text-md px-5 py-3 inline-flex items-center"
                    type="button">
                    2021
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
            </div>

            <form method="GET" action="#" class="flex items-center w-1/2">
                <input
                    type="text"
                    name="search"
                    placeholder="Ketik Nama/Nomor Induk Mahasiswa"
                    class="flex-wrap justify-between mx-auto mr-4 text-black bg-white border border-gray-300 w-full rounded-lg text-md px-5 py-3 inline-flex items-center">
                <button
                    type="submit"
                    class="px-5 py-3 hover:bg-teal-900 bg-teal-700 text-white rounded-lg text-md font-semibold">
                    Cari
                </button>
            </form>
        </div>

        <div class="mt-8 border border-gray-300 rounded-2xl">
            <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                <table class="w-full text-m text-left text-gray-700">
                    <thead class="font-bold text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                        <tr>
                            <th scope="col" class="pl-10">No.</th>
                            <th scope="col" class="pl-2 pr-8">Nama Mahasiswa</th>
                            <th scope="col" class="pr-3">NIM</th>
                            <th scope="col" class="pl-10 pr-3">SKS Lulus</th>
                            <th scope="col" class="pl-10 py-6">IPK</th>
                            <th scope="col" class="pl-14 py-6 pr-5">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b border-gray-300">
                            <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">1.</th>
                            <td class="pl-2 pr-8">John Doe</td>
                            <td class="pr-3">123456789</td>
                            <td class="pl-16">120</td>
                            <td class="pl-10 py-6">3.75</td>
                            <td class="pl-14 py-6 underline-offset-3 underline text-blue-600">
                                <a href="{{ route('dosenpa.prestasi-akademik.mahasiswa') }}">detail</a>
                            </td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">2.</th>
                            <td class="pl-2 pr-8">Jane Smith</td>
                            <td class="pr-3">987654321</td>
                            <td class="pl-16">110</td>
                            <td class="pl-10 py-6">3.50</td>
                            <td class="pl-14 py-6 underline-offset-3 underline text-blue-600">
                                <a href="{{ route('dosenpa.prestasi-akademik.mahasiswa') }}">detail</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white p-10 rounded-2xl my-8 shadow-sm border border-gray-300">
            <div class="text-2xl text-center font-bold ml-12 mb-12">Grafik Akademik Angkatan</div>
            <div class="mx-10 my-12">
                <x-chart-dsn
                    :ip-avg-data="[
                        ['semester' => 'Semester 1', 'ip' => 3.5],
                        ['semester' => 'Semester 2', 'ip' => 3.6],
                        ['semester' => 'Semester 3', 'ip' => 3.7],
                    ]"
                    :ip-max-data="[
                        ['semester' => 'Semester 1', 'ip' => 4.0],
                        ['semester' => 'Semester 2', 'ip' => 4.0],
                        ['semester' => 'Semester 3', 'ip' => 4.0],
                    ]"
                    :ip-min-data="[
                        ['semester' => 'Semester 1', 'ip' => 3.0],
                        ['semester' => 'Semester 2', 'ip' => 3.1],
                        ['semester' => 'Semester 3', 'ip' => 3.2],
                    ]"
                />
            </div>
            <div class="text-md leading-7 bg-gray-100 rounded-lg p-8 border border-gray-300">
                Pada <strong>Semester 3</strong>, IP rata-rata mahasiswa adalah <strong>3.7</strong>. Nilai IP
                tertinggi mencapai <strong>4.0</strong>, sedangkan IP terendah adalah <strong>3.2</strong>. Tren
                rata-rata IP mahasiswa <strong>meningkat</strong> dibandingkan semester sebelumnya.
            </div>
        </div>
    </div>
@endsection
