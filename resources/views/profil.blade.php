@php
    $user = Auth::user();

    $totalsks = DB::table('akademik_semester')->where('nim', $user->nim)->sum('sks');

    $totalIp = DB::table('akademik_semester')->where('nim', $user->nim)->sum('ip');

    $lastSemester = DB::table('akademik_semester')->where('nim', $user->nim)->max('semester');

    $ipk = $lastSemester > 0 ? round($totalIp / $lastSemester, 2) : null;
@endphp

@if (auth()->user()->role === 'admin')
    <x-layout>
        <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
            <x-slot name="title">
                Profil Saya </x-slot>

            <div class="mx-20">
                <div class="text-3xl font-bold mb-12">
                    Profil Saya
                </div>
                <div class=" bg-white shadow-sm rounded-2xl border border-gray-300 pb-12 ">
                    <div class="border-b border-gray-300 py-10 place-items-center">
                        <div class="flex items-center justify-center">
                            <div class="w-32 overflow-hidden bg-gray-100 rounded-full">
                                <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('/public/images/profil.jpg') }}"
                                    class="object-cover w-full h-full aspect-square">
                            </div>
                            <div class="ml-6 leading-7 truncate overflow-hidden text-ellipsis">
                                <div class="font-bold text-gray-900">{{ $user->name }}</div>
                                <div class="text-gray-500">{{ $user->nim }}</div>
                                <div class="text-gray-500">{{ $user->email }}</div>
                            </div>
                        </div>
                    </div>


                    <div class="mx-20 mt-16 pt-8 pb-12 px-16 border rounded-2xl">
                        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex justify-between mb-10 items-center">
                                <div class="text-lg font-bold">
                                    Informasi Pribadi</div>
                                <div>
                                    <button type="submit" id="edit-button"
                                        class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-3 focus:outline-none focus:ring-teal-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center">
                                        <div class="fa fa-pencil mr-2" style="font-size:18px"></div>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                            <div class="grid gap-10 text-md font-semibold">
                                <div class="flex gap-8 col-span-2">
                                    <div class="w-1/2">
                                        <div class="text-gray-600 mb-2">Email</div>
                                        <input type="email" id="email-input" disabled value="{{ $user->email }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal ">
                                    </div>
                                    <div class="w-1/2">
                                        <div class="text-gray-600 mb-2">Foto Diri</div>
                                        <p>
                                            <input type="file" name="foto">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="mx-20 mt-8 pt-10 pb-12 px-16 border rounded-2xl">
                        <div class="flex justify-between mb-10 items-center">
                            <div class="text-lg font-bold">
                                Informasi Dosen</div>
                        </div>
                        <div class="grid gap-10 text-md font-semibold">
                            <div class="flex gap-8 col-span-2">
                                <div class="w-1/2">
                                    <div class="text-gray-600 mb-2">Nama Lengkap</div>
                                    <input type="text" value="{{ $user->name }}" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal">
                                </div>
                                <div class="w-1/2">
                                    <div class="text-gray-600 mb-2">Nomor Induk Pegawai (NIP)</div>
                                    <input type="text" value="{{ $user->nim }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br> <br> <br>
    </x-layout>
@elseif(auth()->user()->role === 'mahasiswa')
    <x-layout>
        <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
            <x-slot name="title">
                Profil Saya </x-slot>

            <div class="mx-20">
                <div class="text-3xl font-bold mb-12">
                    Profil Saya
                </div>
                <div class=" bg-white shadow-sm rounded-2xl border border-gray-300 pb-12">
                    <div class="border-b border-gray-300 py-10 place-items-center">
                        @include('components.profilMhs', ['user' => $user])
                    </div>


                    <div class="mx-20 mt-16 pt-8 pb-12 px-16 border rounded-2xl">
                        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex justify-between mb-10 items-center">
                                <div class="text-lg font-bold">
                                    Informasi Pribadi</div>
                                <div>
                                    <button type="submit" id="edit-button"
                                        class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-3 focus:outline-none focus:ring-teal-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center">
                                        <div class="fa fa-pencil mr-2" style="font-size:18px"></div>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                            <div class="grid gap-10 text-md font-semibold">
                                <div class="flex gap-8 col-span-2">
                                    <div class="w-1/2">
                                        <div class="text-gray-600 mb-2">Email</div>
                                        <input type="email" id="email-input" disabled value="{{ $user->email }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal ">
                                    </div>
                                    <div class="w-1/2">
                                        <div class="text-gray-600 mb-2">Foto Diri</div>
                                        <p>
                                            <input type="file" name="foto">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="mx-20 mt-8 pt-10 pb-12 px-16 border rounded-2xl">
                        <div class="flex justify-between mb-10 items-center">
                            <div class="text-lg font-bold">
                                Informasi Kemahasiswaan</div>
                        </div>
                        <div class="grid gap-10 text-md font-semibold">
                            <div class="flex gap-8 col-span-2">
                                <div class="w-1/2">
                                    <div class="text-gray-600 mb-2">Nama Lengkap</div>
                                    <input type="text" value="{{ $user->name }}" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal">
                                </div>
                                <div class="w-1/2">
                                    <div class="text-gray-600 mb-2">Nomor Induk Mahasiswa (NIM)</div>
                                    <input type="text" value="{{ $user->nim }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal"
                                        disabled>
                                </div>
                            </div>
                            <div class="flex gap-8 col-span-2">
                                <div class="w-1/2">
                                    <div class="text-gray-600 mb-2">Angkatan</div>
                                    <input type="text" value="20{{ substr($user->nim, 5, 2) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal"
                                        disabled>
                                </div>
                                <div class="w-1/2">
                                    <div class="text-gray-600 mb-2">SKS Lulus</div>
                                    <input type="text" value=" {{ $totalsks ?? '0' }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal"
                                        disabled>
                                </div>
                            </div>
                            <div class="flex gap-8 col-span-2">
                                <div class="w-1/2">
                                    <div class="text-gray-600 mb-2">IPK</div>
                                    <input type="text" value="{{ $ipk ?? '-' }}" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-full p-2.5 font-normal">
                                </div>
                                <div class="w-1/2">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <br> <br> <br>
    </x-layout>
@elseif(auth()->user()->role === 'superadmin')
    <script>
        window.location.href = "{{ route('dashboard') }}";
    </script>
@endif
