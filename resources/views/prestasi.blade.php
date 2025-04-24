<x-layout>

    <x-slot name="title">
        Prestasi Akademik
    </x-slot>

    <div class="px-12 pt-12 sm:ml-64 scroll-smooth">

        <div class="text-3xl font-bold mb-12">
            Prestasi Akademik
        </div>

            <div class="pt-20 items-center justify-center pb-12 bg-white shadow-sm rounded-xl h-full">
                <div class="col-span-2 row-span-2 gap-8 mx-20 mb-8">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8 text-center">
                        <div class="py-8 rounded-xl bg-white border border-gray-400 ">
                            <h1 class="text-lg font-bold text-left pl-8 mb-8">Total SKS</h1>
                            <a class="text-4xl text-teal-900 font-bold">11</a>

                            <p class="text-l mt-10 px-8  text-red-600">Belum mencapai syarat minimun kelulusan
                                ≥144
                            </p>
                        </div>
                        <div class="py-8 rounded-xl bg-white border border-gray-400">
                            <h1 class="text-lg font-bold text-left pl-8 mb-8">IPK</h1>
                            <a class="text-4xl text-teal-900 font-bold">3.60</a>
                            <p class="text-l mt-10 px-8 text-green-600">Sudah mencapai syarat minimum kelulusan
                                ≥2.50
                            </p>
                        </div>
                        <div class="py-8 rounded-xl bg-white border border-gray-400">
                            <h1 class="text-lg font-bold text-left pl-8 mb-8">Status</h1>
                            <a class="text-3xl text-teal-900 font-bold">Berprestasi</a>
                            <p class="text-l mt-10 px-8 text-green-600">Tetap terus tingkatkan prestasi akademik
                                Anda
                            </p>

                        </div>
                    </div>
                </div>

                <p class="text-lg font-semibold mx-20 mb-8">Riwayat Prestasi</p>
                <div class="flex ml-20 mr-20 gap-6 items-center">
                    <p class="text-md font-semibold">Periode:</p>
                    <button id="dropdownHoverButton" data-dropdown-toggle="dropdown"
                        class="flex-wrap justify-between mx-auto mr-10 position-absolute text-black bg-white border border-gray-400 hover:border-emerald-600 w-full rounded-lg text-md px-5 py-3 inline-flex items-center"
                        type="button">115<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>




                    <p class="text-md font-semibold">Urutkan:</p>
                    <button id="dropdownSortButton" data-dropdown-toggle="dropdownSort"
                        class="flex-wrap justify-between mx-auto position-absolute text-black bg-white border border-gray-400 hover:border-emerald-600 w-full rounded-lg text-md px-5 py-3 inline-flex items-center"
                        type="button">Tertinggi<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>



                </div>


                <div class="mt-8 mx-20 border border-gray-400 rounded-xl">
                    <div class="overflow-x-auto shadow-sm sm:rounded-xl">
                        <tr>
                            <th>
                                <div class="col-span-2 py-10 pl-8 bg-white ">
                                    <h1 class="text-xl font-bold text-left">Daftar Mata Kuliah</h1>
                                </div>
                            </th>
                        </tr>

                        <table class="w-full text-m text-left text-gray-700">
                            <thead class="font-bold text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                                <tr>
                                    <th scope="col" class="pl-10">
                                        <div>
                                            No.
                                        </div>
                                    </th>
                                    <th scope="col" class="pl-2 pr-8">
                                        <div class="flex items-center">
                                            Nama Mata Kuliah
                                            <a href=""><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                </svg></a>
                                        </div>
                                    </th>

                                    <th scope="col" class="pr-3">
                                        <div class="items-center">
                                            Kode MK
                                        </div>
                                    </th>
                                    <th scope="col" class="pl-10 pr-3">
                                        <div class="flex items-center">
                                            SKS
                                        </div>
                                    </th>
                                    <th scope="col" class="pl-10 py-6">
                                        <div class="flex items-center">
                                            Bobot
                                        </div>
                                    </th>
                                    <th scope="col" class="pl-14 py-6 pr-5">
                                        <div class="flex items-center">
                                            IP
                                        </div>
                                    </th>

                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white border-b border-gray-300">
                                    <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                                        1.
                                    </th>
                                    <td class="pl-2 pr-8">
                                        Pengantar Kecerdasan Buatan

                                    </td>
                                    <td class="pr-3">
                                        12345678
                                    </td>
                                    <td class="pl-10 pr-3">
                                        3
                                    </td>
                                    <td class="pl-10 py-6">
                                        12
                                    </td>
                                    <td class="pl-14 py-6">
                                        <a href="" class="font-bold">A</a>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b border-gray-300">
                                    <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                                        2. </th>
                                    <td class="pl-2 pr-8">
                                        Animasi Komputer
                                    </td>
                                    <td class="pr-3">
                                        12345678
                                    </td>
                                    <td class="pl-10 pr-3">
                                        3
                                    </td>
                                    <td class="pl-10 py-6">
                                        12
                                    </td>
                                    <td class="pl-14 py-6">
                                        <a href="" class="font-bold">A</a>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b border-gray-300">
                                    <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                                        3. </th>
                                    <td class="pl-2 pr-8">
                                        Bahasa Indonesia
                                    </td>
                                    <td class="pr-3">
                                        12345678
                                    </td>
                                    <td class="pl-10 pr-3">
                                        3
                                    </td>
                                    <td class="pl-10 py-6">
                                        10.6
                                    </td>
                                    <td class="pl-14 py-6">
                                        <a href="" class="font-bold">A-</a>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b border-gray-400">
                                    <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                                        4. </th>
                                    <td class="pl-2 pr-8">
                                        Pancasila </td>
                                    <td class="pr-3">
                                        12345678
                                    </td>
                                    <td class="pl-10 pr-3">
                                        2
                                    </td>
                                    <td class="pl-10 py-6">
                                        5
                                    </td>
                                    <td class="pl-14 py-6">
                                        <a href="" class="font-bold">B</a>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b border-gray-400 font-bold">
                                    <th scope="row" class="pl-10 text-gray-900 whitespace-nowrap">
                                        Total </th>
                                    <td class="text-white pl-2 pr-8">
                                        Pancasila </td>
                                    <td class="text-white pr-3">
                                        12345678
                                    </td>
                                    <td class="pl-10 pr-3">
                                        11
                                    </td>
                                    <td class="pl-10 py-6">
                                        39.6
                                    </td>
                                    <td class="text-white pl-14 py-6">
                                        <a href="" class="font-bold">B</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="bg-white pl-8 pt-8 font-medium text-lg">
                            <div class="mb-2">Jumlah SKS Selesai = 11</div>
                            <div class="pb-10">Index Prestasi Kumulatif (IPK) = 3.60</div>

                        </div>
                    </div>
                </div>

                <p class="text-lg font-semibold ml-20 mb-8 mt-10">Grafik Prestasi</p>
                <div class="grid mx-20 grid-cols-2 gap-10 border border-gray-400 rounded-xl">
                    <figure class="m-10">
                        <img class="rounded-lg" src="{{ url('storage/images/grafik.png') }}" alt="">
                    </figure>
                    <div class="m-10 bg-teal-900 text-white rounded-lg text-left content-center">
                        <h3 class="text-lg mx-8 mb-4 font-bold">Penjelasan</h3>
                        <p class= "text-md mx-8 text-wrap">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Duis sed ultricies ex. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Duis
                            sed
                            ultricies ex.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-layout>
