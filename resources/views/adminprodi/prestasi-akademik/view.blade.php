@extends('layouts.app')

@section('title', 'Kelola Prestasi Akademik')

@section('content')


    @include('components.sidebar.adminprodi')

    <div class="mx-32">
        <div class="flex items-center mb-8">
            <div class="text-3xl font-bold mr-8">
                Kelola Prestasi </div>
            <div class="text-right">
                <a type="button"  href="{{ route('adminprodi.prestasi-akademik.create') }}"
                    class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full w-1/2 px-5 py-2.5">Tambah
                    Data</a>
            </div>
        </div>

        @if (session('success'))
            <div id="success-alert"
                class="mb-6 px-6 py-4 rounded-lg bg-green-100 border border-green-400 text-green-700 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button type="button" class="text-green-700 font-bold"
                    onclick="document.getElementById('success-alert').style.display='none'">x</button>
            </div>
        @endif

        <div class="border border-gray-300 rounded-2xl mb-10 mt-12">
            <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                <div class="py-6 px-10 bg-white">
                    <h1 class="text-lg font-bold text-center">Daftar Prestasi Akademik</h1>
                </div>
                <table class="w-full text-sm text-left text-gray-700 table-fixed">
                    <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                        <tr>
                            <th class="pl-10 pr-4 py-4 w-12">No.</th>
                            <th class="px-10 py-4 w-56">Nama</th>
                            <th class="px-6 py-4 w-28">NIM</th>
                            <th class="px-6 py-4 w-24 text-center">Semester</th>
                            <th class="px-6 py-4 w-24 text-center">SKS</th>
                            <th class="px-6 py-4 w-24 text-center">IP</th>
                            <th class="px-4 py-4 w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($akademiks as $index => $item)
                            <tr class="bg-white border-b border-gray-300">
                                <td class="pl-10 pr-4 py-4">{{ $index + 1 }}.</td>
                                <td class="px-10 py-4 font-medium text-black">{{ $item->user->nama ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $item->user->nim ?? '-' }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->semester }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->jml_sks }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->IP }}</td>
                                <td class="px-4 py-4">
                                    <form method="POST"
                                        action="{{ route('adminprodi.prestasi-akademik.deletePrestasi', $item->id) }}"
                                        onsubmit="return confirm('Anda yakin ingin menghapus data prestasi akademik?')"
                                        class="w-full inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center bg-red-500 text-white py-2 rounded w-8">
                                            <i class="fa fa-trash" style="font-size:18px"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border border-gray-300 rounded-2xl">
            <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                <div class="py-6 px-10 bg-white">
                    <h1 class="text-lg font-bold text-center">Daftar Nilai</h1>
                </div>
                <table class="w-full text-left text-gray-700 table-fixed text-sm">
                    <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                        <tr>
                            <th class="pl-10 pr-4 py-4 w-12">No.</th>
                            <th class="px-6 py-4 w-20">NIM</th>
                            <th class="px-6 py-4 w-24">Kode Matkul</th>
                            <th class="px-6 py-4 w-36">Nama Matkul</th>
                            <th class="px-6 py-4 text-center w-16">Nilai</th>
                            <th class="px-6 py-4 text-center w-16">Bobot</th>
                            <th class="px-6 py-4 text-center w-20">Semester</th>
                            <th class="px-4 py-4 w-16">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilais as $index => $item)
                        <tr class="bg-white border-b border-gray-300">
                                <td class="pl-10 pr-4 py-4">{{ $index + 1 }}.</td>
                                <td class="px-6 py-4 font-medium text-black">{{ $item->user->nim ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $item->matkul->kode_matkul ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $item->matkul->nama_matkul ?? '-' }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->nilai }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->bobot }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->semester }}</td>
                                <td class="px-4 py-4">
                                    <form method="POST"
                                        action="{{ route('adminprodi.daftar-nilai.delete', $item->id) }}"
                                        onsubmit="return confirm('Anda yakin ingin menghapus data prestasi akademik?')"
                                        class="w-full inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center bg-red-500 text-white py-2 rounded w-8">
                                            <i class="fa fa-trash" style="font-size:18px"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>


@endsection
