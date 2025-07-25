@extends('layouts.app')

@section('title', 'Prestasi Akademik')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="mx-32">

        <div class="text-3xl font-bold mb-6">Prestasi Akademik</div>

        <div class="grid md:grid-cols-3 gap-6 text-center">
            @include('components.status.dosenpa', ['statusData' => $statusData])
        </div>
        <div class="flex items-center justify-between mt-12">
            <div class="flex gap-4 items-center">
                <div class="text-md font-semibold">Angkatan:</div>
                <button
                    class="text-sm flex-wrap justify-between mx-auto text-black bg-white border border-gray-300 w-72 rounded-lg px-4 py-3 inline-flex items-center"
                    type="button">
                    2021
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
            </div>

            <form method="GET" action="" onsubmit="this.action='/dosenpa/prestasi-akademik/' + this.nim.value;">
                @if (session('error'))
                    <div id="error-alert"
                        class="py-6 px-8 bg-red-100 text-red-800 rounded flex justify-between items-center">
                        {{ session('error') }}
                        <button type="button" class="text-red-800 font-bold"
                            onclick="document.getElementById('error-alert').style.display='none'">x</button>
                    </div>
                @endif
                <input type="text" name="nim" placeholder="Ketik Nomor Induk Mahasiswa" disabled
                    class="flex-wrap text-sm justify-between mx-auto mr-4 text-black bg-white border border-gray-300 w-80 rounded-lg px-4 py-3 inline-flex items-center">
                <button type="submit" class="px-4 py-2 hover:bg-teal-900 bg-teal-700 text-white rounded-lg">
                    Cari
                </button>
            </form>

        </div>
       <div class="mt-8 border border-gray-300 rounded-2xl">
    <div class="overflow-x-auto sm:rounded-2xl">
        <table class="w-full text-sm text-left bg-teal-900 border-collapse">
            <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                <tr>
                    <th scope="col" class="pl-10">No.</th>
                    <th scope="col" class="pl-2 pr-8">Nama Mahasiswa</th>
                    <th scope="col" class="pr-3">NIM</th>
                    <th scope="col" class="pl-16 text-center">Total SKS</th>
                    <th scope="col" class="px-8 py-4 text-center">IPK</th>
                    <th scope="col" class="px-6 py-4">Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $index => $mhs)
                    <tr class="bg-white border-b border-gray-300">
                        <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                            {{ $mahasiswa->firstItem() + $index }}.
                        </th>
                        <td class="pl-2 pr-8 font-medium text-gray-900">{{ $mhs['nama'] }}</td>
                        <td class="pr-3 font-medium text-gray-900">{{ $mhs['nim'] }}</td>
                        <td class="pl-16 text-center">{{ $mhs['total_sks'] }}</td>
                        <td class="px-8 py-4 text-center">{{ $mhs['ipk'] }}</td>
                        <td class="px-6 py-4 underline-offset-3 underline text-blue-600">
                            <a href="{{ route('dosenpa.prestasi-akademik.mahasiswa', ['nim' => $mhs['nim']]) }}">detail</a>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td colspan="6" class="text-center py-8 text-gray-500">Belum ada data mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($mahasiswa->count())
            <div class="my-6 px-8">
                {{ $mahasiswa->links() }}
            </div>
        @endif
    </div>
</div>       

        <div class="bg-white pt-8 my-8 rounded-2xl shadow-sm border border-gray-300">
            <div class="pb-4 text-center text-lg font-bold">Grafik Akademik Angkatan</div>
            @include('components.grafik.dosenpa', ['grafik' => $grafik])
        </div>
    </div>
@endsection
