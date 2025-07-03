@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')

    @include('components.sidebar.adminprodi')

    <div class="max-w-5xl mx-auto mt-10 bg-white shadow-md rounded-lg p-10 border">
        <div class="flex justify-between items-center mb-16">
            <a href="{{ route('adminprodi.kelola-pengguna.view') }}">
                <i class="fa fa-angle-left" style="font-size:36px"></i>
            </a>
            <div class="text-center text-xl font-bold">Ubah Data Pengguna</div>
            <i class="fa fa-angle-left" style="font-size:24px; visibility: hidden;"></i>
        </div>

        @if ($errors->any())
            <div class="my-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Terjadi kesalahan!</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex justify-center px-40">
            <form method="POST" action="{{ route('admin.users.update', $editUser->nim) }}">
                @csrf
                @method('PUT')
                <div class="mb-6 flex">
                    <label for="nama" class="block font-semibold text-gray-600 w-24 content-center">Nama :</label>
                    <input type="text" name="nama" value="{{ old('nama', $editUser->nama) }}"
                        class="w-96 border border-gray-300 text-sm bg-gray-50 rounded-lg p-4">
                </div>

                <div class="mb-6 flex">
                    <label for="email" class="block font-semibold text-gray-600 w-24 content-center">Email :</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $editUser->email) }}"
                        class="w-96 border border-gray-300 text-sm bg-gray-50 rounded-lg p-4">
                </div>

                <div class="mb-12 flex">
                    <label for="nim" class="block font-semibold text-gray-600 w-24 content-center">Nomor Induk
                        :</label>
                    <input type="text" name="nim" id="nim" value="{{ old('nim', $editUser->nim) }}"
                        class="w-96 border border-gray-300 text-sm bg-gray-50 rounded-lg p-4">
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white text-sm px-4 py-4 rounded-lg">
                        <i class="fa fa-check mr-2" style="font-size:16px"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
