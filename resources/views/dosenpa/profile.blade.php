@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-12">
            Profil Saya
        </div>

        <div class="bg-white shadow-sm rounded-2xl border border-gray-300 pb-12">
            <div class="border-b border-gray-300 py-10 grid place-items-center">
                @include('components.profile.dosenpa', ['user' => $user, 'hideKeterangan' => true])

                <form action="{{ route(Auth::user()->role . '.profile.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-1 font-semibold text-gray-900">Upload Foto:</div>
                    <div class="flex items-center gap-3">
                        <input id="foto-input" type="file" name="foto" accept="image/*"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                
                        <button id="upload-button" type="submit"
                            class="bg-teal-700 hover:bg-teal-800 text-white px-4 py-2 text-sm rounded-lg disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>Upload</button>
                    </div>
                    @if ($errors->has('foto'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('foto') }}</p>
                    @endif
                </form>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const fileInput = document.getElementById('foto-input');
                        const submitButton = document.getElementById('upload-button');
                
                        fileInput.addEventListener('change', function () {
                            submitButton.disabled = !fileInput.files.length;
                        });
                    });
                </script>
            </div>

            <div class="mx-32 mt-12 py-12 px-16 border rounded-2xl">
                <div class="flex justify-between mb-10 items-center">
                    <h2 class="text-lg font-bold">
                        Informasi Kepegawaian
                    </h2>
                </div>
                <div class="grid gap-10 text-md">
                    <div class="flex gap-10 col-span-2">
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-2 text-sm font-bold">Nama :</div>
                            <input type="text" value="{{ $user->nama }}" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5">
                        </div>
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-2 text-sm font-bold">NIP :</div>
                            <input type="text" value="{{ $user->nim }}" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5">
                        </div>
                    </div>
                    <div class="flex gap-10 col-span-2">
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-2 text-sm font-bold">Email :</div>
                            <input type="text" value="{{ $user->email }}" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5">
                        </div>
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-2 text-sm font-bold">Mahasiswa Bimbingan Akademik :</div>
                            <input type="text" value="{{ $jumlahMahasiswaBimbingan }}" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5">
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="mx-32 mt-12 py-12 px-16 border rounded-2xl">
                    <div class="flex justify-between mb-10 items-center">
                        <div class="flex items-center justify-between w-full">
                            <div class="text-lg font-bold">
                                Ganti Password
                            </div>
                            @if (session('password_success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                    {{ session('password_success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <label for="current_password" class="text-gray-600 mb-2 text-sm font-bold block">Password
                                :</label>
                            <input type="password" name="current_password" id="current_password" required
                                class="bg-gray-50 border border-gray-300 text-gray-700 rounded-lg block w-full p-2.5">
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="new_password" class="text-gray-600 mb-2 text-sm font-bold block">Password Baru :</label>
                            <input type="password" name="new_password" id="new_password" required
                                class="bg-gray-50 border border-gray-300 text-gray-700 rounded-lg block w-full p-2.5">
                            @error('new_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="new_password_confirmation" class="text-gray-600 mb-2 text-sm font-bold block">Konfirmasi Password Baru :</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                                class="bg-gray-50 border border-gray-300 text-gray-700 rounded-lg block w-full p-2.5">
                            @error('new_password_confirmation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit"
                            class="bg-teal-700 hover:bg-teal-800 text-white px-4 py-3 text-sm rounded-lg">
                            <i class="fa fa-check mr-2" style="font-size:16px;color:white"></i>Simpan </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
