@extends('layouts.app')

@section('title', 'Prestasi Akademik')

@section('content')

    @include('components.sidebar.mahasiswa')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-6">
            Prestasi Akademik
        </div>

        <div class="grid md:grid-cols-3 gap-6 text-center">
            @include('components.status.mahasiswa', ['ipksks' => $ipksks])
        </div>

        <div class="text-2xl w-fit font-semibold mt-10 mb-6">Riwayat Akademik</div>

        <div class="mt-8 border border-gray-300 rounded-2xl">
            <div class="overflow-x-auto sm:rounded-2xl">
                <div class="p-10 bg-white border-b border-gray-300 rounded-t-2xl">
                    <h1 class="text-lg font-bold text-left">Daftar Mata Kuliah</h1>
                </div>

                <table class="w-full text-sm text-left bg-teal-900 border-collapse">
                    <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                        <tr>
                            <th scope="col" class="pl-10">No.</th>
                            <th class="pl-8">Nama Mata Kuliah</th>
                            <th class="px-4 py-4">Kode MK</th>
                            <th class="pl-12 py-4 text-center">SKS</th>
                            <th class="pl-12 py-4 text-center">Bobot</th>
                            <th class="px-10 py-4 text-center">Nilai</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $index => $item)
                            <tr class="bg-white border-b border-gray-300">
                                <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $index + 1 }}.</th>
                                <td class="pl-8 font-medium text-gray-900">{{ $item->nama_matkul }}</td>
                                <td class="px-4 py-4">{{ $item->kode_matkul }}</td>
                                <td class="pl-12 py-4 text-center">{{ $item->jml_sks }}</td>
                                <td class="pl-12 py-4 text-center">{{ $item->bobot }}</td>
                                <td class="px-10 py-4 text-center">{{ $item->nilai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-6 px-8">
                    {{ $data->links() }}
                </div>
                <div class="bg-white px-8 py-8 text-base border-t border-gray-300 font-semibold">
                    <div class="mb-2">Jumlah SKS Lulus = {{ $ipksks['total_sks'] }}</div>
                    <div>Index Prestasi Kumulatif (IPK) = {{ $ipksks['ipk'] }}</div>
                </div>
            </div>
        </div>

        <div class="bg-white pt-8 mt-8 rounded-2xl shadow-sm border border-gray-300">
            <div class="pb-12 text-center text-lg font-bold">Grafik Akademik</div>
            @include('components.grafik.mahasiswa', [
                'user' => $user,
                'ipData' => $ipData,
                'ipAvgData' => $ipAvgData,
            ])
        </div>
    </div>

@endsection
