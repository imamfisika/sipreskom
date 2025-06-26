@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    @include('components.sidebarMahasiswa')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-12">
            Profil Saya
        </div>

        <div class="bg-white shadow-sm rounded-2xl border border-gray-300 pb-12">
            <div class="border-b border-gray-300 py-10 grid place-items-center">
                @include('components.profilMahasiswa', ['user' => $user])
            </div>

            <div class="mx-32 mt-12 py-12 px-16 border rounded-2xl">
                <div class="flex justify-between mb-10 items-center">
                    <div class="text-lg font-bold">
                        Informasi Kemahasiswaan</div>
                </div>
                <div class="grid gap-10 text-md font-semibold">
                    <div class="flex gap-10 col-span-2">
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-2">Nama Lengkap</div>
                            <input type="text" value="John Doe" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal">
                        </div>
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-2">Nomor Induk Mahasiswa (NIM)</div>
                            <input type="text" value="1234567890"
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal"
                                disabled>
                        </div>
                    </div>
                    <div class="flex gap-10 col-span-2">
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-2">Angkatan</div>
                            <input type="text" value="2020"
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal"
                                disabled>
                        </div>
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-2">SKS Lulus</div>
                            <input type="text" value="120"
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal"
                                disabled>
                        </div>
                    </div>
                    <div class="flex gap-10 col-span-2">
                        <div class="w-1/2">
                            <div class="text-gray-600 mb-2">IPK</div>
                            <input type="text" value="3.75" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal">
                        </div>
                        <div class="w-1/2">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
