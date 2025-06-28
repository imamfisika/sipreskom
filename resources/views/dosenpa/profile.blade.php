@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    @include('components.sidebar.dosenpa')

    <div class="container mx-auto px-8">
        <div class="text-3xl font-bold mb-12">
            Profil Saya
        </div>

        <div class="bg-white shadow-sm rounded-2xl border border-gray-300 pb-12">
            <div class="border-b border-gray-300 py-10 grid place-items-center">
                @include('components.profile.dosenpa', ['user' => $user])
            </div>

            <div class="mx-8 mt-12 py-12 px-8 border rounded-2xl">
                <div class="flex justify-between mb-10 items-center">
                    <h2 class="text-lg font-bold">Informasi Kepegawaian</h2>
                </div>
                <div class="grid gap-10 text-md font-semibold">
                    <div class="flex gap-10">
                        <div class="w-1/2">
                            <label class="text-gray-600 mb-2 block">Nama Lengkap</label>
                            <input type="text" value="John Doe" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal">
                        </div>
                        <div class="w-1/2">
                            <label class="text-gray-600 mb-2 block">Nomor Induk Pegawai (NIP)</label>
                            <input type="text" value="1234567890" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal">
                        </div>
                    </div>
                    <div class="flex gap-10">
                        <div class="w-1/2">
                            <label class="text-gray-600 mb-2 block">Email</label>
                            <input type="text" value="johndoe@gmail.com" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal">
                        </div>
                        <div class="w-1/2">
                            <label class="text-gray-600 mb-2 block">Mahasiswa Bimbingan Akademik</label>
                            <input type="text" value="24" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
