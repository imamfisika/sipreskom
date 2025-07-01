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

                <form action="{{ route(Auth::user()->role . '.profile.upload') }}" method="POST" enctype="multipart/form-data"
                    class="">
                    @csrf
                    <div class="flex items-center gap-3">
                        <input type="file" name="foto" accept="image/*"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        <button type="submit"
                            class="bg-teal-700 hover:bg-teal-800 text-white px-4 py-2 text-sm rounded-lg">Upload</button>
                    </div>
                </form>

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
                            <div class="text-gray-600 mb-4 font-semibold">Nama :</div>
                            <input type="text" value="{{ $user->nama }}" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5">
                        </div>
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-4 font-semibold">NIP :</div>
                            <input type="text" value="{{ $user->nim }}" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5">
                        </div>
                    </div>
                    <div class="flex gap-10 col-span-2">
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-4 font-semibold">Email :</div>
                            <input type="text" value="{{ $user->email }}" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5">
                        </div>
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-4 font-semibold">Mahasiswa Bimbingan Akademik :</div>
                            <input type="text" value="{{ $jumlahMahasiswaBimbingan }}" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
