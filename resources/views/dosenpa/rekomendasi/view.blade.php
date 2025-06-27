@extends('layouts.app')

@section('title', 'Rekomendasi')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="mx-32">
        <div class="flex items-center mb-8">
            <div class="text-3xl font-bold mr-8">
                Rekomendasi </div>
            <div class="text-right">
                <a type="button"  href="{{ route('dosenpa.rekomendasi.tambah') }}"
                    class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full w-1/2 px-5 py-2.5">Tambah
                    Rekomendasi</a>
            </div>
        </div>

        <div class="border border-gray-300 rounded-2xl mt-12">
            <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                <tr>
                    <th>
                        <div class="flex bg-white items-center justify-between py-12 px-10">
                            <div class="text-xl font-bold text-left">Daftar Rekomendasi Terakhir</div>
                        </div>
                    </th>
                </tr>

                <table class="w-full text-m text-left text-gray-700">
                    <thead class="font-bold text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                        <tr>
                            <th class="pl-10 pr-1 border-b py-6">Tanggal</th>
                            <th class="pl-12 pr-4 border-b">Mahasiswa</th>
                            <th class="px-6 border-b">Dosen</th>
                            <th class="pl-20 border-b">Rekomendasi Mata Kuliah</th>
                            <th class="pl-16 pr-4 border-b">Saran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b bg-white">
                            <td class="pl-10 pr-1 py-6 text-sm text-gray-600">01 Jan 2023</td>
                            <td class="pl-12 pr-2 font-semibold">John Doe</td>
                            <td class="pl-6">Dr. Smith</td>
                            <td class="pl-20">
                                <div class="flex flex-wrap gap-2">
                                    <span class="max-w-48 truncate bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full border border-indigo-500">
                                        Matematika
                                    </span>
                                    <span class="max-w-48 truncate bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full border border-indigo-500">
                                        Fisika
                                    </span>
                                </div>
                            </td>
                            <td class="pl-16 pr-8 text-gray-800">
                                <div class="flex items-center gap-2">
                                    <i class="fa fa-check-square" style="font-size:18px; color:green;"></i>
                                    <span>Disarankan untuk fokus pada mata kuliah inti</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b bg-white">
                            <td class="pl-10 pr-1 py-6 text-sm text-gray-600">05 Feb 2023</td>
                            <td class="pl-12 pr-2 font-semibold">Jane Smith</td>
                            <td class="pl-6">Dr. Brown</td>
                            <td class="pl-20">
                                <div class="flex flex-wrap gap-2">
                                    <span class="max-w-48 truncate bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full border border-indigo-500">
                                        Dasar-dasar pemrograman
                                    </span>
                                    <span class="max-w-48 truncate bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full border border-indigo-500">
                                        Organisasi Komputer
                                    </span>
                                </div>
                            </td>
                            <td class="pl-16 pr-8 text-gray-800">
                                <div class="flex items-center gap-2">
                                    <i class="fa fa-check-square" style="font-size:18px; color:green;"></i>
                                    <span>Perlu meningkatkan pemahaman pada mata kuliah dasar</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b bg-white">
                            <td class="pl-10 pr-1 py-6 text-sm text-gray-600">10 Mar 2023</td>
                            <td class="pl-12 pr-2 font-semibold">Alex Johnson</td>
                            <td class="pl-6">Dr. Taylor</td>
                            <td class="pl-20">
                                <div class="flex flex-wrap gap-2">
                                    <span class="max-w-48 truncate bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full border border-indigo-500">
                                        Komputer
                                    </span>
                                    <span class="max-w-48 truncate bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full border border-indigo-500">
                                        Statistik
                                    </span>
                                </div>
                            </td>
                            <td class="pl-16 pr-8 text-gray-800">
                                <div class="flex items-center gap-2">
                                    <i class="fa fa-check-square" style="font-size:18px; color:green;"></i>
                                    <span>Disarankan untuk mengikuti pelatihan tambahan</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
