<x-layout>
    <div class="px-40 pt-16 sm:ml-64 scroll-smooth">


        <div class="mx-20">
            <div class="text-3xl font-bold mb-8">
                Rekomendasi </div>

            <div>
                <div class="flex items-center mb-8">
                    <div class="text-md font-semibold">Semester: </div>
                    <button id="dropdownHoverButton" data-dropdown-toggle="dropdown"
                        class="justify-between mx-4 text-black bg-white border border-gray-300 w-96 rounded-lg text-md px-5 py-3 inline-flex items-center"
                        type="button">115<svg class="w-2.5 h-2.5 " aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    {{-- <div id="dropdown" class="hidden z-10 w-96 bg-white rounded-lg shadow">
                        <ul class="py-2 text-md text-gray-700 border border-gray-400 rounded-lg">
                            <li>
                                <a href="#" class="block px-4 py-3 hover:bg-gray-100"
                                    onclick="changeValueAndClose('115')">115</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-3 hover:bg-gray-100"
                                    onclick="changeValueAndClose('116')">116</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-3 hover:bg-gray-100"
                                    onclick="changeValueAndClose('117')">117</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>

                <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 pt-6 py-8 px-8">
                    <div class="font-bold text-xl text-black">
                        Sistem</div>
                    <div class="h-72"></div>
                </div>

                <div class="grid grid-cols-2 gap-6 mt-8  ">
                    <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 pt-6 py-8 px-8">
                        <div class="border-b border-gray-300 pt-2 pb-6 flex justify-between">
                            <div>
                                <div class="mb-2 text-gray-400 font-semibold">
                                    24 April 2025</div>
                                <div class="font-bold text-xl text-black">
                                    Dr. Ria Arafiyah, M.Si. </div>
                            </div>
                            <div>
                                <div class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-4 py-1.5 rounded-md">
                                    Terbaru
                                </div>
                            </div>
                        </div>
                        <div class="font-semibold text-md mt-8">Rekomendasi mata kuliah:</div>
                        <div class="grid grid-cols-2 w-96 gap-4">
                            <div
                                class=" text-center mt-4 w-48 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate overflow-hidden">
                                Pengantar Kecerdasan Buatan</div>
                            <div
                                class="text-center mt-4 w-48 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate overflow-hidden">
                                Animasi Komputer</div>

                        </div>
                        <div class="font-semibold text-md mt-8">Saran:</div>

                        <div class="mt-3 flex content-center">
                            <div class="text-md font-medium text-gray-800 w-96"> <i class="fa fa-check-square mr-1"
                                    style="font-size:20px;color:green"></i>
                                Minimal 20 SKS untuk semester depan</div>
                        </div>
                        <div class="mt-3 flex content-center">
                            <div class="text-md font-medium text-gray-800 w-96"> <i class="fa fa-check-square mr-1"
                                    style="font-size:20px;color:green"></i>
                                Mengulang mata kuliah Kaldif</div>
                        </div>
                        <div class="mt-3 flex content-center">
                            <div class="text-md font-medium text-gray-800 w-96"> <i class="fa fa-check-square mr-1"
                                    style="font-size:20px;color:green"></i>
                                Ikut bootcamp di bidang algoritma & database</div>
                        </div>

                    </div>
                    <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 pt-6 pb-8 px-8">
                        <div class="border-b border-gray-300 pt-2 pb-6 flex justify-between">
                            <div>
                                <div class="mb-2 text-gray-400 font-semibold">
                                    12 April 2025</div>
                                <div class="font-bold text-xl text-black">
                                    Drs Mulyono, M.Kom. </div>
                            </div>
                            <div>
                                <span
                                    class="bg-red-100 text-red-800 text-sm font-semibold px-4 py-1.5 rounded-md">Penting</span>
                            </div>
                        </div>
                        <div class="font-semibold text-md mt-8">Rekomendasi mata kuliah:</div>
                        <div class="grid grid-cols-2 items-left w-96 gap-4">
                            <div
                                class="text-center mt-4 w-48 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate overflow-hidden">
                                Kalkulus Integral</div>
                            <div
                                class="text-center mt-4 w-48 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate overflow-hidden">
                                Matematika Diskrit</div>

                        </div>
                        <div class="font-semibold text-md mt-8">Saran:</div>

                        <div class="mt-3 flex content-center">
                            <div class="text-md font-medium text-gray-800 w-96"> <i class="fa fa-check-square mr-1"
                                    style="font-size:20px;color:green"></i>
                                Bimbingan belajar tambahan</div>
                        </div>
                        <div class="mt-3 flex content-center">
                            <div class="text-md font-medium text-gray-800 w-96"> <i class="fa fa-check-square mr-1"
                                    style="font-size:20px;color:green"></i>
                                Konsultasi akademik</div>
                        </div>
                        <div class="mt-3 flex content-center">
                            <div class="text-md font-medium text-gray-800 w-96"> <i class="fa fa-check-square mr-1"
                                    style="font-size:20px;color:green"></i>
                                Manajemen waktu belajar</div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
</x-layout>
