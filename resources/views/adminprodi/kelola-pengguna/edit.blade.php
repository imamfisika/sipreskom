@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')

    @include('components.sidebar.adminprodi')

    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-8 border">
        <div class="text-center text-2xl font-bold mb-12">Edit Data Pengguna</div>
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
    <form method="POST" action="{{ route('admin.users.update', $editUser->nim) }}">
        @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="nama" class="block font-semibold mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $editUser->nama) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <div class="mb-6">
                <label for="email" class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $editUser->email) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <div class="mb-12">
                <label for="nim" class="block font-semibold mb-1">NIM/NIP</label>
                <input type="text" name="nim" id="nim" value="{{ old('nim', $editUser->nim) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <button type="submit"
                class="justify-center bg-teal-700 hover:bg-teal-800 text-white font-semibold px-4 py-2.5 rounded-lg">
                <i class="fa fa-check mr-2" style="font-size:16px"></i>
                Simpan Perubahan
            </button>
        </form>

    </div>
@endsection
