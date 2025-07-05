@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @include('components.sidebar.mahasiswa')

    <div class="text-3xl font-bold mb-12">Dashboard Mahasiswa</div>

    <div class="grid grid-cols-5 grid-rows-3 gap-6 mb-8">

        <div class="col-span-3 rounded-2xl bg-teal-900 text-white shadow-sm py-6 pl-8">
            <div class="text-xl font-semibold text-left mb-3">
                Selamat Datang, {{ $user->nama }}</div>
            <div class="text-sm">
                Yuk pantau dan selalu tingkatkan prestasi akademik Anda melalui SIPRESKOM.
            </div>
        </div>

        @include('components.status.mahasiswa', ['ipksks' => $ipksks])

        <div class="col-span-2 row-span-3 col-start-4 bg-white shadow-sm rounded-2xl pt-8 text-left border border-gray-300">
            <div class="text-center mb-6 text-lg font-bold">Profil Saya</div>
            @include('components.profile.mahasiswa', ['user' => $user])
        </div>

    </div>

    <div class="grid grid-cols-5 grid-rows-1 gap-6 mb-8">
        <div class="col-span-3 bg-white shadow-sm rounded-2xl border border-gray-300">
            <div class="overflow-x-auto sm:rounded-2xl">
                <div class="p-10 bg-white border-b border-gray-300 rounded-t-2xl">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="text-lg font-bold text-left">Riwayat Akademik</div>
                        <a href="{{ route('mahasiswa.prestasi-akademik.index') }}"
                            class="transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full text-sm px-4 py-2">
                            Lihat semua
                        </a>
                    </div>
                </div>
                <table class="w-full text-sm text-left bg-teal-900 border-collapse">
                    <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                        <tr>
                            <th class="pl-8">Nama Mata Kuliah</th>
                            <th class="px-4 py-4">Kode MK</th>
                            <th class="pl-12 py-4 text-center">SKS</th>
                            <th class="pl-12 py-4 text-center">Bobot</th>
                            <th class="px-10 py-4 text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayatAkademik->take(5) as $data)
                            <tr class="bg-white border-b border-gray-300">
                                <td class="pl-8 py-4 font-medium text-gray-900">{{ $data->nama_matkul }}</td>
                                <td class="px-4 py-4 ">{{ $data->kode_matkul }}</td>
                                <td class="pl-12 py-4 text-center">{{ $data->jml_sks }}</td>
                                <td class="pl-12 py-4 text-center">{{ $data->bobot }}</td>
                                <td class="px-10 py-4 text-center">{{ $data->nilai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div
    class="col-span-2 row-span-1 col-start-4 py-8 bg-white shadow-sm rounded-2xl text-left px-10 border border-gray-300 h-96">
    <div class="text-center text-lg font-bold mb-6">Rekomendasi</div>
    <div class="mx-1 grid gap-2.5">
        @forelse ($rekomendasis as $rekomendasi)
            <div class="font-semibold text-base mt-2">{{ $rekomendasi->nama_dosen }}</div>
            <div class="flex gap-2 items-start text-sm text-gray-800 max-w-[24rem]">
                <i class="fa fa-angle-double-right mt-1 text-green-600" style="font-size:18px;"></i>
                <div class="line-clamp-2">
                    {{ $rekomendasi->keterangan }}
                </div>
            </div>
        @empty
            <div class="text-sm text-gray-500">Belum ada rekomendasi dari dosen PA.</div>
        @endforelse
    </div>
</div>

    </div>

    <div class="pt-8 rounded-2xl bg-white shadow-sm border border-gray-300">
        <div class="pb-12 text-center text-lg font-bold">Grafik Akademik</div>
        @include('components.grafik.mahasiswa', [
            'user' => $user,
            'ipData' => $ipData,
            'ipAvgData' => $ipAvgData,
        ])
    </div>

@endsection
