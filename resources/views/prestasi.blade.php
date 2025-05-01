<x-layout>

    <x-slot name="title">
        Prestasi Akademik
    </x-slot>

    <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
        <div class="mx-20 text-3xl font-bold mb-2">
            Prestasi Akademik
        </div>
        <div class="col-span-2 row-span-2  mx-20 mb-8">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center ">
                @include('components.statusAkademik')

            </div>
        </div>

        <div class="bg-white p-10 rounded-2xl mx-20 mb-8 shadow-sm border border-gray-300">
            <div class="text-2xl text-center font-bold ml-12 mb-12 uppercase">Grafik Prestasi</div>
            <div class="mx-10 my-12">
                <div id="labels-chart"></div>
            </div>
            <div
                class="mx-12 pt-8 py-8 bg-gray-100 text-black border border-gray-400 rounded-lg text-left content-center">
                <div class="text-lg mx-8 mb-4 font-bold">Penjelasan</div>
                <div class= "text-md mx-8 text-wrap leading-7">Secara umum, IP Anda mengalami
                    kenaikan dengan kecenderungan lebih tinggi dibandingkan rata-rata angkatan. Perbedaan ini
                    mencerminkan dinamika performa akademik Anda
                    dari waktu ke waktu.</div>
            </div>
        </div>

        <div class="text-2xl font-bold mx-20 my-10 uppercase">Riwayat Akademik</div>
        <div class="flex mx-20 gap-6 items-center">
            <div class="text-md font-semibold">Periode:</div>
            <button id="dropdownHoverButton" data-dropdown-toggle="dropdown"
                class="flex-wrap justify-between mx-auto mr-10 text-black bg-white border border-gray-300 w-full rounded-lg text-md px-5 py-3 inline-flex items-center"
                type="button">115<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div class="text-md font-semibold">Urutkan:</div>
            <button id="dropdownSortButton" data-dropdown-toggle="dropdownSort"
                class="flex-wrap justify-between mx-auto text-black bg-white border border-gray-300 w-full rounded-lg text-md px-5 py-3 inline-flex items-center"
                type="button">Tertinggi<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
        </div>
        <div class="mt-8 mx-20 border border-gray-300 rounded-2xl">
            <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                <tr>
                    <th>
                        <div class="p-10 bg-white ">
                            <h1 class="text-xl font-bold text-left">Daftar Mata Kuliah</h1>
                        </div>
                    </th>
                </tr>

                <table class="w-full text-m text-left text-gray-700">
                    <thead class="font-bold text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                        <tr>
                            <th scope="col" class="pl-10">No.</th>
                            <th scope="col" class="pl-2 pr-8">
                                <div class="flex items-center">
                                    Nama Mata Kuliah
                                    <a href="">
                                        <svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg>
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="pr-3">Kode MK</th>
                            <th scope="col" class="pl-10 pr-3">SKS</th>
                            <th scope="col" class="pl-10 py-6">Bobot</th>
                            <th scope="col" class="pl-14 py-6 pr-5">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b border-gray-300">
                            <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">1.</th>
                            <td class="pl-2 pr-8">Pengantar Kecerdasan Buatan</td>
                            <td class="pr-3">12345678</td>
                            <td class="pl-10 pr-3">3</td>
                            <td class="pl-10 py-6">12</td>
                            <td class="pl-14 py-6">
                                <div>A</div>
                            </td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">2.</th>
                            <td class="pl-2 pr-8">Animasi Komputer</td>
                            <td class="pr-3">12345678</td>
                            <td class="pl-10 pr-3">3</td>
                            <td class="pl-10 py-6">12</td>
                            <td class="pl-14 py-6">
                                <div>A</div>
                            </td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">3.</th>
                            <td class="pl-2 pr-8">Bahasa Indonesia</td>
                            <td class="pr-3">12345678</td>
                            <td class="pl-10 pr-3">3</td>
                            <td class="pl-10 py-6">10.6</td>
                            <td class="pl-14 py-6">
                                <div>A-</div>
                            </td>
                        </tr>
                        <tr class="bg-white border-b border-gray-400">
                            <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">4.</th>
                            <td class="pl-2 pr-8">Pancasila</td>
                            <td class="pr-3">12345678</td>
                            <td class="pl-10 pr-3">2</td>
                            <td class="pl-10 py-6">5</td>
                            <td class="pl-14 py-6">
                                <div>B</div>
                            </td>
                        </tr>
                        <tr class="bg-white border-b border-gray-400 font-bold">
                            <th scope="row" class="pl-10 text-gray-900 whitespace-nowrap">Total</th>
                            <td class="text-white pl-2 pr-8"></td>
                            <td class="text-white pr-3"></td>
                            <td class="pl-10 pr-3">11</td>
                            <td class="pl-10 py-6">39.6</td>
                            <td class="text-white pl-14 py-6"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="bg-white pl-8 pt-8 font-medium text-lg">
                    <div class="mb-2">Jumlah SKS Lulus = 11</div>
                    <div class="pb-10">Index Prestasi Kumulatif (IPK) = 3.60</div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
</x-layout>
