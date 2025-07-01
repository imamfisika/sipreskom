@extends('layouts.app')

@section('title', 'Rekomendasi')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="mx-32">
        <div class="flex items-center mb-8">
            <div class="text-3xl font-bold mr-8">
                Rekomendasi </div>
            <div class="text-right">
                <a href="{{ route('dosenpa.rekomendasi.tambah') }}"
                    class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full w-1/2 px-5 py-2.5">Tambah
                    Rekomendasi</a>
            </div>
        </div>

        <div class="border border-gray-300 rounded-2xl mt-12">
            <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                <div class="py-6 px-10 bg-white">
                    <h1 class="text-lg font-bold text-center">Daftar Rekomendasi Terakhir</h1>
                </div>

                <table class="w-full text-sm text-left text-gray-700 table-fixed">
                    <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                        <tr>
                            <th class="px-6 border-b py-4 w-24">Tanggal</th>
                            <th class="px-6 border-b w-40">Mahasiswa</th>
                            <th class="px-6 border-b w-40">Dosen</th>
                            <th class="px-6 border-b w-[50%]">Rekomendasi Matkul</th>
                            <th class="px-4 pr-4 border-b w-[30%]">Saran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekomendasis as $rekomendasi)
                            <tr class="border-b bg-white">
                                <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($rekomendasi->created_at)->format('d M Y') }}</td>
                                <td class="px-6 font-semibold">{{ $rekomendasi->mahasiswa->nama }}</td>
                                <td class="px-6">{{ $rekomendasi->nama_dosen }}</td>
                                <td class="px-6">
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($rekomendasi->matkuls as $matkul)
                                            <span
                                                class="max-w-56 truncate bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full border border-indigo-500">
                                                {{ $matkul }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 text-gray-800">
                                    <div class="flex items-center gap-2">
                                        <i class="fa fa-check-square text-green-600"></i>
                                        <span>{{ $rekomendasi->keterangan }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500">Belum ada rekomendasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
