@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @include('components.sidebar.adminprodi')

    <div class="text-3xl font-bold mb-12">Dashboard Admin</div>
    <div class="grid grid-cols-5 grid-rows-3 gap-6 mb-6">
        <div class="col-span-3 rounded-2xl bg-teal-900 text-white shadow-sm py-6 pl-8">
            <div class="text-xl font-semibold text-left mb-4">
                Selamat Datang, Admin Program Studi
            </div>
            <div class="text-normal">
                Kelola pengguna dan pantau perkembangan prestasi akademik mahasiswa melalui SIPRESKOM.
            </div>
        </div>

        @include('components.statusPrestasiMahasiswa')

        <div class="col-span-2 row-span-3 col-start-4 bg-white shadow-sm rounded-2xl pt-8 text-left border border-gray-300">
            <div class="text-center mb-6 text-xl font-bold">Profil Saya</div>
            <div class="pl-12 mb-6 pr-10">
                @include('components.profile.adminprodi')
            </div>
            <div class="px-12">
                <div class="mb-6 font-normal leading-7 text-ellipsis">
                    Admin Program Studi Ilmu Komputer
                    Fakultas Matematika dan Ilmu Pengetahuan Alam
                    Universitas Negeri Jakarta
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6 mt-6">

        <div class="bg-white shadow-sm rounded-2xl border border-gray-300">
            <div class="overflow-x-auto sm:rounded-2xl">
                <tr>
                    <th class="h-24">
                        <div class="py-10 pl-8 bg-white border-gray-300">
                            <div class="flex items-center gap-6 flex-wrap justify-between mx-auto">
                                <div class="text-xl font-bold text-left">Daftar Dosen</div>
                                <a href="{{ route('adminprodi.kelola-pengguna.view', ['role' => 'dosen']) }}"
                                    class="transition ease-in-out duration-150 hover:bg-teal-800 text-white mr-8 bg-teal-700 font-semibold rounded-full text-sm px-4 py-2 mb-1">
                                    Lihat semua
                                </a>
                            </div>
                        </div>
                    </th>
                </tr>

                <table class="w-full text-md text-left bg-teal-900 border-collapse">
                    <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                        <tr>
                            <th class="pl-8">No.</th>
                            <th class="pl-12 pr-6">Nama Dosen</th>
                            <th class="pl-8 py-6">Nomor Induk</th>
                            <th class="pl-12 pr-4">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 font-medium text-gray-900">1.</td>
                            <td class="pl-12 pr-6">Dr. Ahmad Fauzi</td>
                            <td class="pl-8 py-6">1987654321</td>
                            <td class="pl-12 pr-4">ahmad@gmail.com</td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 font-medium text-gray-900">2.</td>
                            <td class="pl-12 pr-6">Prof. Siti Aminah</td>
                            <td class="pl-8 py-6">1987654322</td>
                            <td class="pl-12 pr-4">aminah@gmail.com</td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 font-medium text-gray-900">3.</td>
                            <td class="pl-12 pr-6">Dr. Budi Santoso</td>
                            <td class="pl-8 py-6">1987654323</td>
                            <td class="pl-12 pr-4">santoso@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white shadow-sm rounded-2xl border border-gray-300">
            <div class="overflow-x-auto sm:rounded-2xl">
                <tr>
                    <th class="h-24">
                        <div class="py-10 pl-8 bg-white border-gray-300">
                            <div class="flex items-center gap-6 flex-wrap justify-between mx-auto">
                                <div class="text-xl font-bold text-left">Daftar Mahasiswa</div>
                                <a href="{{ route('adminprodi.kelola-pengguna.view', ['role' => 'mahasiswa']) }}"
                                    class="transition ease-in-out duration-150 hover:bg-teal-800 text-white mr-8 bg-teal-700 font-semibold rounded-full text-sm px-4 py-2 mb-1">
                                    Lihat semua
                                </a>
                            </div>
                        </div>
                    </th>
                </tr>

                <table class="w-full text-md text-left bg-teal-900 border-collapse">
                    <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                        <tr>
                            <th class="pl-8">No.</th>
                            <th class="pl-12 pr-6">Nama Mahasiswa</th>
                            <th class="pl-8 py-6">Nomor Induk</th>
                            <th class="pl-12 pr-4">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 font-medium text-gray-900">1.</td>
                            <td class="pl-12 pr-6">Ahmad Zaki</td>
                            <td class="pl-8 py-6">2101234567</td>
                            <td class="pl-12 pr-4">zaki@gmail.com</td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 font-medium text-gray-900">2.</td>
                            <td class="pl-12 pr-6">Siti Nurhaliza</td>
                            <td class="pl-8 py-6">2101234568</td>
                            <td class="pl-12 pr-4">siti@gmail.com</td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <td class="pl-8 font-medium text-gray-900">3.</td>
                            <td class="pl-12 pr-6">Budi Santoso</td>
                            <td class="pl-8 py-6">2101234569</td>
                            <td class="pl-12 pr-4">budi@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
