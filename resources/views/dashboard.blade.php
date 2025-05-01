<x-layout>

    <x-slot name="title">
        Dashboard
    </x-slot>

    <div class="pl-20 px-12 pt-12 sm:ml-64 scroll-smooth">

        <div class="text-3xl font-bold mb-12">
            Dashboard
        </div>

        {{-- CONTENT 1 --}}
        <div class="grid grid-cols-5 grid-rows-3 gap-6 mb-8">
            <div class="col-span-3 rounded-2xl bg-teal-900 text-white shadow-sm py-6 pl-8">
                <div class="text-xl font-bold text-left mb-4">Selamat Datang, Izzat!</div>
                <a class="text-l ">Yuk pantau dan selalu tingkatkan prestasi akademik Anda melalui SIPRESKOM.</a>
            </div>

            @include('components.statusAkademik')

            {{-- PROFIL --}}
            <div
                class="col-span-2 row-span-3 col-start-4 bg-white shadow-sm rounded-2xl pt-8 text-left border border-gray-300">
                <div class="text-center mb-8 text-xl font-bold uppercase">Profil</div>
                <div class="flex gap-5 pl-8 mb-5">
                    <div class=" w-20 h-20 overflow-hidden rounded-full">
                        <img class="h-auto max-w-full rounded-lg" src="{{ url('storage/images/profil.jpeg') }}"
                            alt="">
                    </div>
                    <div class="leading-7">
                        <div class="font-bold text-lg">Muhammad Izzat Azizan</div>
                        <div class="text-m font-medium text-gray-500">NIM. 1313621013</div>
                        <div class="text-m font-medium text-gray-800"> ijat@mhs.unj.ac.id</div>
                    </div>
                </div>
                <div class="pl-8 px-10 pb-6 text-wrap text-md text-gray-500">Mahasiswa Program Studi Ilmu
                    Komputer Fakultas Matematika dan Ilmu Pengetahuan Alam UNJ angkatan 2021.
                </div>
                <div class="pl-8">
                    {{-- DOSPEM PROFIL --}}
                    <div class="text-md font-bold mb-6">Dosen Pembimbing Akademik:</div>
                    <div class="flex gap-4 mb-12">
                        <div class=" overflow-hidden bg-gray-100 rounded-full">
                            <img class="w-14 h-14 max-w-full" src="{{ url('storage/images/pakmul.jpg') }}"
                                alt="">
                        </div>
                        <div class="leading-7">
                            <div class="font-bold text-md">Drs Mulyono, M.Kom.</div>
                            <div class="text-md text-gray-500">NIP. 196605171994031003</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- CONTENT 2 --}}
        <div class="grid grid-cols-5 grid-rows-1 gap-6 mb-8 ">

            <div class="col-span-3 bg-white shadow-sm rounded-2xl border border-gray-300">
                <div class="overflow-x-auto sm:rounded-2xl">
                    <tr>
                        <th class="h-24">
                            <div class="py-8 pl-8 bg-white border-gray-300">
                                <div class="flex items-center gap-6 flex-wrap justify-between mx-auto">
                                    <div class="text-xl font-bold text-left uppercase">Riwayat Akademik</div>
                                    <a type="button" href="prestasi-akademik"
                                        class="transition ease-in-out duration-150 hover:bg-teal-800 text-white mr-8 bg-teal-700 font-bold rounded-full text-sm px-4 py-2 mb-1">Lihat
                                        semua</a>
                                </div>
                            </div>
                        </th>
                    </tr>

                    <table class="w-full text-md text-left bg-teal-900">
                        <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                            <tr>
                                <th class="pl-8">Nama Mata Kuliah</th>
                                <th class="pl-2 py-6 pr-3">Kode MK</th>
                                <th class="pl-10 py-6">SKS</th>
                                <th class="pl-14 py-6 pr-5">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b border-gray-300">
                                <td class="pl-8 py-4 font-medium text-gray-900">Pengantar Kecerdasan Buatan</td>
                                <td class="pl-2 py-6 pr-3">31452023</td>
                                <td class="pl-10 py-6">3</td>
                                <td class="pl-14 py-6">A</td>
                            </tr>
                            <tr class="bg-white border-b border-gray-300">
                                <td class="pl-8 py-4 font-medium text-gray-900">Animasi Komputer</td>
                                <td class="pl-2 py-6 pr-3">31450043</td>
                                <td class="pl-10 py-6">3</td>
                                <td class="pl-14 py-6">A</td>
                            </tr>
                            <tr class="bg-white">
                                <td class="pl-8 py-4 font-medium text-gray-900">Bahasa Indonesia</td>
                                <td class="pl-2 py-6 pr-3">30050062</td>
                                <td class="pl-10 py-6">3</td>
                                <td class="pl-14 py-6">A-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div
                class="col-span-2 row-span-1 col-start-4 pt-8 bg-white shadow-sm rounded-2xl text-left pl-8 pr-10 border border-gray-300">
                <div class="text-center text-xl font-bold uppercase mb-8">Rekomendasi</div>
                <div class="mx-1 grid gap-8 max-w-fit">
                    <div>
                        <div class="font-bold text-md">Dr. Ria Arafiyah, M.Si.</div>
                        <div class="text-md leading-6 mt-2 text-gray-500">Minimal 20 SKS untuk semester depan, Mengulang
                            mata kuliah Kaldif, Ikut bootcamp di bidang algoritma & database</div>
                    </div>
                    <div>
                        <div class="font-bold text-md">Drs. Mulyono, M.Kom.</div>
                        <div class="text-md leading-6 mt-2 text-gray-500">Bimbingan belajar tambahan,
                            Konsultasi akademik,
                            Manajemen waktu belajar</div>
                    </div>
                </div>
            </div>
        </div>


        {{-- CONTENT 3 --}}
        <div class="h-auto rounded-2xl bg-white shadow-sm border border-gray-300">
            <div class="pt-8 pb-12 text-center text-xl uppercase font-bold">Grafik Prestasi</div>
            <div class="grid grid-cols-2 pb-8 mx-12 gap-8 items-center">
                <div id="labels-chart"></div>
                <div
                    class="h-fit bg-gray-100 text-black border border-gray-400 rounded-lg text-left px-8 py-8 content-center">
                    <div class="text-lg mb-4 font-bold">Penjelasan</div>
                    <div class="text-md text-wrap leading-7">Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Duis sed ultricies ex.</div>
                </div>
            </div>
        </div>

    </div>

    <br> <br> <br>
</x-layout>
