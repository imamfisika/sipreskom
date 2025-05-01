<x-layout>
    <div class="px-40 pt-16 sm:ml-64 scroll-smooth">


        <div class="mx-20">
            <div class="text-3xl font-bold mb-8">
                Profil Saya
            </div>
            <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 pb-12">
                <div class="flex place-content-left items-center pl-20 border-b py-12">
                    <div class="w-36 overflow-hidden bg-gray-100 rounded-full">
                        <img src="{{ url('storage/images/profil.jpeg') }}" alt="profile">
                    </div>

                    <div class="ml-12">
                        <div class="block mb-2 text-md font-semibold text-gray-600" for="file_input">Upload new photo
                        </div>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50"
                            aria-describedby="file_input_help" id="file_input" type="file">
                        <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG, or JPEG is allowed<br>
                            at least 800x800 px recommended.</p>

                    </div>
                </div>

                <div class="mx-20 mt-12 pt-8 pb-12 px-10 border rounded-2xl">
                    <div class="flex justify-between mb-10 items-center">
                        <div class="text-lg font-bold">
                            Informasi Pribadi</div>
                        <div>
                            <button type="button"
                                class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-3 focus:outline-none focus:ring-teal-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center">
                                <div class="fa fa-pencil mr-2" style="font-size:18px"></div>
                                Ubah data
                            </button>
                        </div>
                    </div>
                    <div class="grid gap-10 text-md font-semibold">
                        <div class="flex col-span-2">
                            <div class="w-3/5">
                                <div class="text-gray-400 mb-2">Nama Lengkap</div>
                                <div class="text-black">Muhammad Izzat Azizan</div>
                            </div>
                            <div>
                                <div class="text-gray-400 mb-2">Email</div>
                                <div class="text-black">ijat@mhs.unj.ac.id</div>
                            </div>
                        </div>
                        <div class="flex col-span-2">
                            <div class="w-3/5">
                                <div class="text-gray-400 mb-2">No. Telepon</div>
                                <div class="text-black">0812345678910</div>
                            </div>
                            {{-- <div>
                                <div class="text-gray-400 mb-2">Jenis Kelamin</div>
                                <div class="text-black">Laki-laki</div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="mx-20 mt-8 pt-10 pb-12 px-10 border rounded-2xl">
                    <div class="flex justify-between mb-10 items-center">
                        <div class="text-lg font-bold">
                           Informasi Kemahasiswaan</div>
                    </div>
                    <div class="grid gap-10 text-md font-semibold">
                        <div class="flex col-span-2">
                            <div class="w-3/5">
                                <div class="text-gray-400 mb-2">Nomor Induk Mahasiswa (NIM)</div>
                                <div class="text-black">1313621013</div>
                            </div>
                            <div>
                                <div class="text-gray-400 mb-2">Angkatan</div>
                                <div class="text-black">2021</div>
                            </div>
                        </div>
                        <div class="flex col-span-2">
                            <div class="w-3/5">
                                <div class="text-gray-400 mb-2">Status Mahasiswa</div>
                                <div class="text-black">Aktif</div>
                            </div>
                            <div>
                                <div class="text-gray-400 mb-2">Semester</div>
                                <div class="text-black">8</div>
                            </div>
                        </div>
                        <div class="flex col-span-2">
                            <div class="w-3/5">
                                <div class="text-gray-400 mb-2">Jumlah SKS Lulus</div>
                                <div class="text-black">142</div>
                            </div>
                            <div>
                                <div class="text-gray-400 mb-2">IPK</div>
                                <div class="text-black">3.56</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="mx-6 text-left">
                    @include('components.profileEdit')
                </div> --}}
        </div>
    </div>
    <br> <br> <br>
</x-layout>
