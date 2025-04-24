<x-layout>

    <x-slot name="title">
       Dashboard
    </x-slot>

    <div class="px-12 pt-12 sm:ml-64 scroll-smooth">

        <div class="text-3xl font-bold mb-12">
            Dashboard
        </div>

        {{-- CONTENT 1 --}}
        <div class="grid grid-cols-5 grid-rows-3 gap-6 mb-8">
            <div class="col-span-3 rounded-xl bg-teal-900 text-white shadow-sm py-6 pl-8">
                <div class="text-xl font-bold text-left mb-3">Selamat Datang, Izzat!</div>
                <a class="text-l ">Yuk pantau dan selalu tingkatkan prestasi akademik Anda melalui SIPRESKOM.</a>
            </div>
            <div class="row-span-2 row-start-2 bg-white shadow-sm rounded-xl pt-6 text-center">
                <div class="text-lg font-bold text-left mb-8 pl-8">Total SKS</div>
                <a class="text-3xl text-teal-900 font-bold">11</a>
                <p class="text-md mt-12 px-8 text-red-600">Belum mencapai syarat minimun kelulusan ≥144
                </p>
            </div>
            <div class="row-span-2 row-start-2 bg-white shadow-sm rounded-xl pt-6 text-center">
                <div class="text-lg font-bold text-left pl-8 mb-8">IPK</div>
                <a class="text-3xl text-teal-900 font-bold">3.60</a>
                <p class="text-md mt-12 px-8 text-green-600">Sudah mencapai syarat minimum kelulusan ≥2.50
                </p>
            </div>
            <div class="row-span-2 row-start-2 bg-white shadow-sm rounded-xl pt-6 text-center">
                <div class="text-lg font-bold text-left pl-8 mb-8">Status</div>
                <a class="text-2xl text-teal-900 font-bold">Berprestasi</a>
                <p class="text-md mt-12 px-8 text-green-600">Tetap terus tingkatkan prestasi akademik Anda
                </p>
            </div>

            {{-- PROFIL --}}
            <div class="col-span-2 row-span-3 col-start-4 bg-white shadow-sm rounded-xl pt-8 text-left">
                <div class="text-center mb-8 text-xl font-bold uppercase">Profil</div>
                <div class="flex items-top gap-5 pl-8 mb-5">
                    <div class=" w-20 h-20 overflow-hidden rounded-full">
                        <img class="h-auto max-w-full rounded-lg" src="{{ url('storage/images/profil.jpeg') }}"
                            alt="">
                    </div>
                    <div class="leading-7">
                        <div class="font-bold text-lg">Muhammad Izzat Azizan</div>
                        <div class="text-m font-medium text-gray-500">NIM. 1313621013</div>
                        <div class="text-m font-medium text-gray-800"> ijat@gmail.com</div>
                    </div>
                </div>
                <div class= "px-8 pb-6 text-wrap text-md text-gray-500">Mahasiswa Program Studi Ilmu
                    Komputer Fakultas Matematika dan Ilmu Pengetahuan Alam UNJ angkatan 2021.
                </div>
                <div class="pl-8">
                    {{-- DOSPEM PROFIL --}}
                    <div class="text-md font-bold mb-4">Dosen Pembimbing Akademik:</div>
                    <div class="flex items-center gap-4 mb-12">
                        <div class=" overflow-hidden bg-gray-100 rounded-full">
                            <img class="w-12 h-12 max-w-full" src="{{ url('storage/images/profil.jpeg') }}"
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
        <div class="grid grid-cols-5 grid-rows-1 gap-6 mb-8">

            <div class="col-span-3 bg-white shadow-sm rounded-xl">
                <div class="overflow-x-auto shadow-sm sm:rounded-xl">
                    <tr>
                        <th class="h-24">
                            <div class="py-8 pl-8 bg-white border-gray-300">
                                <div class="flex items-center gap-6 flex-wrap justify-between mx-auto">
                                    <div class="text-xl font-bold text-left uppercase">Riwayat Prestasi</div>
                                    <a type="button" href="prestasi-akademik"
                                        class="focus:outline-none transition ease-in-out duration-150 text-white mr-8 bg-teal-700 font-bold rounded-md text-sm px-4 py-2 mb-1">Lihat
                                        semua</a>
                                </div>
                            </div>
                        </th>
                    </tr>

                    <table class="w-full text-md text-left bg-teal-900">
                        <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                            <tr>
                                <th scope="col" class="pl-8">
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

                                <th scope="col" class="pl-2 py-6 pr-3">
                                    <div class="flex items-center">
                                        Kode MK
                                    </div>
                                </th>
                                <th scope="col" class="pl-10 py-6">
                                    <div class="flex items-center">
                                        SKS
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
                                <th scope="row" class="pl-8 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Pengantar Kecerdasan Buatan
                                </th>
                                <td class="pl-2 py-6 pr-3">
                                    12345678
                                </td>
                                <td class="pl-10 py-6">
                                    3
                                </td>
                                <td class="pl-14 py-6">
                                    <div>A</div>
                                </td>
                            </tr>
                            <tr class="bg-white border-b border-gray-300">
                                <th scope="row" class="pl-8 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Animasi Komputer
                                </th>
                                <td class="pl-2 py-6 pr-3">
                                    12345678
                                </td>
                                <td class="pl-10 py-6">
                                    3
                                </td>
                                <td class="pl-14 py-6">
                                    <div>A</div>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <th scope="row" class="pl-8 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Bahasa Indonesia
                                </th>
                                <td class="pl-2 py-6 pr-3">
                                    12345678
                                </td>
                                <td class="pl-10 py-6">
                                    3
                                </td>
                                <td class="pl-14 py-6">
                                    <div>A-</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                </p>
            </div>

            <div class="col-span-2 row-span-1 col-start-4 pt-8 bg-white shadow-sm rounded-xl text-left px-8">
                <div class="text-center text-xl font-bold uppercase mb-10">Rekomendasi</div>
                <div class="mb-6">
                    <div>
                        <div class="font-bold text-lg">Dr. Ria Arafiyah, M.Si.</div>
                        <div class= "mt-2 text-gray-500">Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Duis sed ultricies ex. Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Duis sed ultricies ex.</div>
                    </div>
                </div>
                <div>
                    <div class="font-bold text-lg">Drs Mulyono, M.Kom.</div>
                    <div class= "mt-2 text-gray-500">Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Duis sed ultricies ex. Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Duis sed ultricies ex.</div>
                </div>
            </div>
        </div>


        {{-- CONTENT 3 --}}
        <div class="h-auto rounded-xl bg-white shadow-sm">

            <div class="flex justify-center items-center gap-8 pt-8 pb-12">
                <div class="text-xl uppercase font-bold">Grafik Prestasi</div>
                <div class="rounded-md shadow-xs">
                    <button type="button" onclick="toggleActive(this, 'semester')"
                        class="toggle-btn px-4 py-2 text-sm font-bold border rounded-s-md focus:z-10 bg-teal-700 text-white">
                        Semester
                    </button><button type="button" onclick="toggleActive(this, 'tahunan')"
                        class="toggle-btn px-4 py-2 text-sm font-bold border rounded-e-md focus:z-10 bg-white text-black">
                        Tahunan
                    </button>
                </div>
                <script>
                    function toggleActive(button, type) {
                        const buttons = document.querySelectorAll('.toggle-btn');
                        buttons.forEach(btn => {
                            btn.classList.remove('bg-teal-700', 'text-white');
                            btn.classList.add('bg-white', 'text-black');
                        });
                        button.classList.remove('bg-white', 'text-black');
                        button.classList.add('bg-teal-700', 'text-white');

                        // Handle content change without refreshing the page
                        const content = document.querySelector('.content-area'); // Replace with your content container
                        if (type === 'semester') {
                            content.innerHTML = '<p>Content for Semester</p>'; // Replace with actual content
                        } else if (type === 'tahunan') {
                            content.innerHTML = '<p>Content for Tahunan</p>'; // Replace with actual content
                        }
                    }

                    // Set default content for Semester
                    document.addEventListener('DOMContentLoaded', () => {
                        const defaultButton = document.querySelector('.toggle-btn.bg-teal-700');
                        toggleActive(defaultButton, 'semester');
                    });
                </script>
            </div>

            <div class="grid grid-cols-2 pb-8 mx-8 gap-20">
                <figure>
                    <img class="h-auto" src="{{ url('storage/images/grafik.png') }}" alt="">
                </figure>
                <div class="h-auto bg-teal-900 text-white rounded-lg text-left pl-8 pr-12 py-8 content-center">
                    <div class="text-lg mb-4 font-bold">Penjelasan</div>
                    <div class= "text-md text-wrap">Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Duis sed ultricies ex. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed
                        ultricies ex.</div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
