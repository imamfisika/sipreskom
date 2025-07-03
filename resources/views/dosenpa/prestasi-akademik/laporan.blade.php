@extends('layouts.app')

@section('title', 'Laporan Akademik')

@section('content')
    @include('components.sidebar.dosenpa')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-12">
            Laporan Akademik
        </div>

        <div class="flex items-center justify-between mt-12 mb-8">
            <div class="flex gap-4 items-center">
                <div class="text-md font-semibold">Angkatan:</div>
                <button
                    class="text-sm flex-wrap justify-between mx-auto text-black bg-white border border-gray-300 w-72 rounded-lg text-md px-4 py-3 inline-flex items-center"
                    type="button">
                    2021
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
            </div>

            <div>
                <a href="{{ route('dosenpa.prestasi-akademik.unduhLaporan') }}"
                    class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full w-1/2 px-5 py-2.5">
                    Unduh Laporan
                </a>
            </div>
        </div>

        <div class="border border-gray-300 rounded-2xl">
            <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                <div class="py-6 px-10 bg-white">
                    <h1 class="text-lg font-bold text-center">Daftar Mahasiswa</h1>
                </div>

                <table class="w-full text-sm text-left text-gray-700 table-fixed">
                    <thead class="text-white bg-teal-900 border-y border-gray-400">
                        <tr>
                            <th class="w-16 px-6 py-4">No.</th>
                            <th class="w-72 px-6 py-4">Nama Mahasiswa</th>
                            <th class="px-6 py-4">NIM</th>
                            <th class="px-6 py-4 text-center">Total SKS</th>
                            <th class="px-6 py-4 text-center">IPK</th>
                            <th class="w-48 px-6 py-4">Status Akademik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswa as $index => $mhs)
                            <tr class="bg-white border-b border-gray-300">
                                <td class="px-6 py-4 font-medium text-gray-900 text-center">{{ $index + 1 }}.</td>
                                <td class="px-6 py-4 font-medium text-gray-900 truncate">{{ $mhs['nama'] }}</td>
                                <td class="px-6 py-4">{{ $mhs['nim'] }}</td>
                                <td class="px-6 py-4 text-center">{{ $mhs['total_sks'] }}</td>
                                <td class="px-6 py-4 text-center">{{ number_format($mhs['ipk'], 2) }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    @if ($mhs['ipk'] > 3.5)
                                        Berprestasi
                                    @elseif ($mhs['ipk'] >= 3.01)
                                        Cukup Berprestasi
                                    @else
                                        Kurang Berprestasi
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    Tidak ada data mahasiswa bimbingan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
