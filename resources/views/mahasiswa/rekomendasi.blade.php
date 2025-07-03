@extends('layouts.app')

@section('title', 'Rekomendasi')

@section('content')

    @include('components.sidebar.mahasiswa')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-12">Rekomendasi</div>

        <div class="flex items-center gap-3 mb-8">
            <div class="text-md font-semibold">Semester:</div>
            <button
                class="text-sm justify-between text-black bg-white border border-gray-300 w-72 rounded-lg text-md px-4 py-3 inline-flex items-center"
                type="button">
                Semua
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-300">
            <div class="pb-12 text-center text-lg font-bold">Prediksi Indeks Prestasi</div>

            @include('components.grafik.mahasiswa', ['user' => $user, 'hideDeskripsi' => true])

            <div class="flex justify-center items-center">
                <div class="flex gap-6">
                    <div class="flex flex-col justify-between h-full w-2/5">
                        <div class="text-sm mb-5 border border-gray-300 bg-gray-100 p-4 rounded-xl h-full">
                            <div class="font-semibold mb-2">Prediksi IP Semester 5 :</div> 3.68
                        </div>
                        <div class="text-sm border border-gray-300 bg-gray-100 p-4 rounded-xl h-full">
                            <div class="font-semibold mb-2">Kategori Prestasi:</div> Berprestasi
                        </div>
                    </div>
                    <div class="flex-1">
                        @if (!empty($matkulUlang))
                            <div class="border border-gray-300 bg-gray-100 p-4 rounded-xl h-full flex flex-col">
                                <div class="font-semibold text-sm mb-2">Mata Kuliah Mengulang:</div>
                                <ul class="list-disc pl-6 text-sm text-gray-800">
                                    @foreach ($matkulUlang as $matkul)
                                        <li class="mb-2">
                                            <span class="text-red-600">
                                                {{ $matkul['nama_matkul'] }} ({{ $matkul['kode_matkul'] }}):
                                                <strong>{{ $matkul['nilai'] }}</strong>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>



        <div class="grid gap-6 my-8">
            <div class="overflow-x-auto">
                <div class="flex gap-6 flex-nowrap">
                    @forelse($rekomendasis as $timestamp => $group)
                        <div class="bg-white border border-gray-300 shadow-sm rounded-2xl p-8 min-w-[40%]">
                            <div class="border-b border-gray-300 pt-2 pb-6 flex justify-between">
                                <div>
                                    <div class="mb-1 text-gray-500 text-sm">
                                        {{ \Carbon\Carbon::parse($timestamp)->format('d M Y') }}
                                    </div>
                                    <div class="font-bold text-lg"> {{ $group->nama_dosen }}
                                    </div>
                                </div>
                                <div>
                                    @if ($loop->first)
                                        <div
                                            class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1.5 rounded-md item">
                                            Terbaru
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6 font-semibold text-sm">Rekomendasi Mata Kuliah:</div>
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach ($group->group as $rekom)
                                    <span
                                        class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm border border-indigo-500">
                                        {{ $rekom->matkul_rekomendasi }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="mt-10 font-semibold mb-2 text-sm">Saran:</div>
                            <div class="flex items-center gap-2 text-sm text-gray-800">
                                <i class="fa fa-check-square text-green-600"></i>
                                <div>{{ $group->keterangan }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500 text-md text-center">Belum ada rekomendasi dari Dosen Pembimbing Akademik.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
