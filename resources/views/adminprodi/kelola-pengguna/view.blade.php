@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')

    @include('components.sidebarAdminprodi')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-12">
            Kelola Pengguna </div>

        <div class="flex flex-row gap-6 items-center mb-8 ">

            <div class="text-2xl font-semibold">Pilih role : </div>

            <div class="inline-flex shadow-xs" role="group">
                <a href="{{ route('adminprodi.kelola-pengguna.view', ['role' => 'dosen']) }}" type="button"
                    class="px-5 py-3 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-2 focus:ring-teal-700 focus:text-teal-700">
                    Dosen
                </a>
                <a href="{{ route('adminprodi.kelola-pengguna.view', ['role' => 'mahasiswa']) }}" type="button"
                    class="px-5 py-3 text-sm font-medium text-gray-900 bg-white border border-gray-300 border-l-0 rounded-e-lg hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-2 focus:ring-teal-700 focus:text-teal-700">
                    Mahasiswa
                </a>
            </div>
        </div>

        @php
            $data = [
                'mahasiswa' => [
                    [
                        'nama' => 'Ahmad Fauzi',
                        'nim' => '1234567890',
                        'email' => 'ahmad@example.com',
                        'role' => 'mahasiswa',
                        'id' => 1,
                        'ubah' => 'Ubah',
                        'hapus' => 'Hapus',
                    ],
                    [
                        'nama' => 'Siti Nurhaliza',
                        'nim' => '0987654321',
                        'email' => 'siti@example.com',
                        'role' => 'mahasiswa',
                        'id' => 2,
                        'ubah' => 'Ubah',
                        'hapus' => 'Hapus',
                    ],
                    [
                        'nama' => 'Siti Nurhaliza',
                        'nim' => '0987654321',
                        'email' => 'siti@example.com',
                        'role' => 'mahasiswa',
                        'id' => 3,
                        'ubah' => 'Ubah',
                        'hapus' => 'Hapus',
                    ],
                ],
                'dosen' => [
                    [
                        'nama' => 'Dr. Budi Santoso',
                        'nim' => '197511212005012004',
                        'email' => 'budi@example.com',
                        'role' => 'dosenpa',
                        'id' => 1,
                        'ubah' => 'Ubah',
                        'hapus' => 'Hapus',
                    ],
                    [
                        'nama' => 'Prof. Ani Wijaya',
                        'nim' => '197512312005012003',
                        'email' => 'ani@example.com',
                        'role' => 'dosenpa',
                        'id' => 2,
                        'ubah' => 'Ubah',
                        'hapus' => 'Hapus',
                    ],
                ],
            ];
        @endphp

        @if (isset($role) && isset($data[$role]))
            <div class="border border-gray-300 rounded-2xl">
                <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                    <tr>
                        <th>
                            <div class="p-10 bg-white ">
                                <h1 class="text-xl font-semibold text-left">Daftar {{ ucfirst($role) }}</h1>
                            </div>
                        </th>
                    </tr>

                    <table class="w-full text-m text-left text-gray-700">
                        <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                            <tr>
                                <th scope="col" class="pl-10 pr-6 py-6">No.</th>
                                <th scope="col" class="px-6 py-6">
                                    <div class="flex items-center">
                                        Nama Lengkap </div>
                                </th>
                                <th scope="col" class="px-6 py-6">Nomor Induk</th>
                                <th scope="col" class="px-6 py-6">Email</th>
                                <th scope="col" class="px-1 py-6">Ubah</th>
                                <th scope="col" class="px-1 py-6">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data[$role] ?? [] as $user)
                                <tr class="bg-white border-b border-gray-300">
                                    <th scope="row" class="pl-10 pr-6 py-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $user['id'] }}</th>
                                    <td class="px-6 py-6 font-medium text-gray-900"> {{ $user['nama'] }}</td>
                                    <td class="px-6 py-6"> {{ $user['nim'] }}</td>
                                    <td class="px-6 py-6"> {{ $user['email'] }}</td>

                                    <td class="px-1 py-6">
                                        <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-800 text-sm text-white px-3 py-1.5 rounded">
                                            <div class="fa fa-pencil mr-1" style="font-size:15px"></div>
                                            {{ $user['ubah'] }}
                                        </button>
                                    </td>
                                    <td class="px-1 py-6">
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-800 text-sm text-white px-3 py-1.5 rounded">
                                            <div class="fa fa-eraser mr-1" style="font-size:15px"></div>
                                            {{ $user['hapus'] }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- <tr>
                                <td colspan="6" class="p-11 py-4 border-b border-gray-300 bg-gray-100">
                                    <!-- Pagination placeholder -->
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="border border-gray-300 rounded-2xl">
                <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                    <tr>
                        <th>
                            <div class="p-10 bg-white ">
                                <div class="text-red-500 text-xl font-bold">Silakan pilih role Mahasiswa atau Dosen untuk menampilkan daftar pengguna.</div>
                            </div>
                        </th>
                    </tr>

                    <table class="w-full text-m text-left text-gray-700">
                        <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                            <tr>
                                <th scope="col" class="pl-10 pr-6 py-6">No.</th>
                                <th scope="col" class="px-6 py-6">
                                    <div class="flex items-center">
                                        Nama Lengkap </div>
                                </th>
                                <th scope="col" class="px-6 py-6">Nomor Induk</th>
                                <th scope="col" class="px-6 py-6">Email</th>
                                <th scope="col" class="px-1 py-6">Ubah</th>
                                <th scope="col" class="px-1 py-6">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="p-11 py-4 border-b border-gray-300 bg-white">
                                    <div class="text-gray-500 text-center py-10 font-semibold">Tidak ada data yang ditampilkan</div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
