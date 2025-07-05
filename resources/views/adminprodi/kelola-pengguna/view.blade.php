@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')


    @include('components.sidebar.adminprodi')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-12">Kelola Pengguna</div>

        <div class="flex flex-row gap-6 items-center mb-8">
            <div class="text-lg font-semibold">Pilih role:</div>
            <div class="inline-flex shadow-xs" role="group">
                <a href="{{ route('adminprodi.kelola-pengguna.view', ['role' => 'dosen']) }}"
                    class="px-5 text-sm py-3 font-medium {{ request('role') === 'dosen' ? 'text-white bg-teal-700' : 'text-gray-700 bg-white' }} border border-gray-300 rounded-s-lg hover:bg-gray-200 hover:text-black focus:z-10 focus:ring-2 focus:ring-teal-700 focus:text-teal-700">
                    Dosen
                </a>
                <a href="{{ route('adminprodi.kelola-pengguna.view', ['role' => 'mahasiswa']) }}"
                    class="px-5 text-sm py-3 font-medium {{ request('role') === 'mahasiswa' ? 'text-white bg-teal-700' : 'text-gray-700 bg-white' }} border border-gray-300 border-l-0 rounded-e-lg hover:bg-gray-200 hover:text-black focus:z-10 focus:ring-2 focus:ring-teal-700 focus:text-teal-700">
                    Mahasiswa
                </a>
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

        @if (isset($role) && isset($data[$role]))
            <div class="border border-gray-300 rounded-2xl">
                <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                    <div class="py-6 px-10 bg-white">
                        <h1 class="text-lg font-bold text-center">Daftar {{ ucfirst($role) }}</h1>
                    </div>
                    <table class="w-full text-sm text-left text-gray-700 table-fixed">
                        <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                            <tr>
                                <th class="pl-10 pr-4 py-4 w-12">No.</th>
                                <th class="px-10 py-4 w-56">Nama</th>
                                <th class="px-6 py-4 w-36">Nomor Induk</th>
                                <th class="px-6 py-4 w-40">Email</th>
                                <th class="py-4 w-16 text-center">Ubah</th>
                                <th class="px-4 py-4 w-16 text-center">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data[$role] as $index => $user)
                                <tr class="bg-white border-b border-gray-300">
                                    <td class="pl-10 pr-4 py-4">{{ $index + 1 }}.</td>
                                    <td class="px-10 py-4 font-medium text-black truncate">{{ $user['nama'] }} </td>
                                    <td class="px-6 py-4 truncate">{{ $user['nim'] }}</td>
                                    <td class="px-6 py-4 truncate overflow-hidden whitespace-nowrap">{{ $user['email'] }}
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                      <a href="{{ route('admin.users.edit', ['nim' => $user->nim]) }}"
                                            class="inline-flex items-center justify-center bg-indigo-600 text-white py-2 rounded w-8">
                                            <i class="fa fa-pencil" style="font-size:18px"></i>
                                        </a>
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <form method="POST" action="{{ route('admin.users.delete', $user['id']) }}"
                                            onsubmit="return confirm('Anda yakin ingin menghapus pengguna?')" class="w-full inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center bg-red-500 text-white py-2 rounded w-8">
                                                <i class="fa fa-eraser" style="font-size:18px"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="border border-gray-300 rounded-2xl">
                <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                    <div class="py-6 px-10 bg-white">
                        <div class="text-red-500 text-lg text-center font-bold">Silakan pilih role Mahasiswa atau Dosen untuk
                            menampilkan daftar pengguna.</div>
                    </div>
                    <table class="w-full text-left text-gray-700 table-fixed text-sm">
                        <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                            <tr>
                                <th class="pl-10 pr-4 py-4 w-12">No.</th>
                                <th class="px-10 py-4 w-56">Nama Lengkap</th>
                                <th class="px-6 py-4 w-36">Nomor Induk</th>
                                <th class="px-6 py-4 w-40">Email</th>
                                <th class="px-4 py-4 w-16 text-center">Ubah</th>
                                <th class="px-4 py-4 w-16 text-center">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="p-11 py-4 border-b border-gray-300 bg-white">
                                    <div class="text-gray-500 text-center py-10 font-semibold">Tidak ada data yang
                                        ditampilkan</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
