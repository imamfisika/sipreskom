@extends('layouts.app')

@section('title', 'Laporan Akademik')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="mx-20">
        <div class="text-3xl font-bold mb-12">
            Laporan Akademik
        </div>

        <div class="flex justify-between mb-6 items-center">
            <div class="flex items-center gap-6">
                <div class="text-md font-semibold">Angkatan:</div>
                <button
                    class="flex-wrap justify-between mx-auto text-black bg-white border border-gray-300 w-96 rounded-lg text-md px-5 py-3 inline-flex items-center"
                    type="button">2021<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
            </div>
            <div>
                <a type="button"
                    class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full w-1/2 px-5 py-2.5 mr-2">Cetak
                    Laporan</a>
                <a type="button"
                    class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full w-1/2 px-5 py-2.5">Unduh
                    Laporan</a>
            </div>

        </div>

        <div class="mt-8 border border-gray-300 rounded-2xl">
            <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
            <tr>
            <th>
            <div class="p-10 bg-white ">
                <h1 class="text-xl font-bold text-left">Daftar Mahasiswa</h1>
            </div>
            </th>
            </tr>

            <table class="w-full text-m text-left text-gray-700">
            <thead class="font-bold text-gray-200 border-b border-t bg-teal-900 border-gray-400">
            <tr>
                <th scope="col" class="pl-10">No.</th>
                <th scope="col" class="pl-2 pr-8">
                <div class="flex items-center">
                Nama Mahasiswa
                </div>
                </th>
                <th scope="col" class="pr-12">NIM</th>
                <th scope="col" class="pl-10 pr-12">SKS Lulus</th>
                <th scope="col" class="px-10 py-6">IPK</th>
                <th scope="col" class="pl-10 py-6">Status Akademik</th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b border-gray-300">
                <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                1.
                </th>
                <td class="pl-2 pr-8">John Doe</td>
                <td class="pr-12">123456789</td>
                <td class="pl-16 pr-8">120</td>
                <td class="px-10 py-6">3.75</td>
                <td class="pl-10 py-6">Berprestasi</td>
            </tr>
            <tr class="bg-white border-b border-gray-300">
                <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                2.
                </th>
                <td class="pl-2 pr-8">Jane Smith</td>
                <td class="pr-12">987654321</td>
                <td class="pl-16 pr-8">110</td>
                <td class="px-10 py-6">3.60</td>
                <td class="pl-10 py-6">Cukup Berprestasi</td>
            </tr>
            <tr class="bg-white border-b border-gray-300">
                <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                3.
                </th>
                <td class="pl-2 pr-8">Alice Johnson</td>
                <td class="pr-12">112233445</td>
                <td class="pl-16 pr-8">130</td>
                <td class="px-10 py-6">3.90</td>
                <td class="pl-10 py-6">Berprestasi</td>
            </tr>
            </tbody>
            </table>

            </div>
        </div>
    </div>
@endsection
