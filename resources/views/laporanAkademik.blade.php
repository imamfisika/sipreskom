@if (auth()->user()->role === 'admin')
    <x-layout>
        <x-slot name="title">
            Laporan Akademik
        </x-slot>

        <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
            <div class="mx-20">
                <div class="text-3xl font-bold mb-12">
                    Laporan Akademik
                </div>

                <div class="flex justify-between mb-8 items-center">
                    <div class="flex items-center gap-6">
                        <div class="text-md font-semibold">Angkatan:</div>
                        <button
                            class="flex-wrap justify-between mx-auto text-black bg-white border border-gray-300 w-96 rounded-lg text-md px-5 py-3 inline-flex items-center"
                            type="button">2021<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                    </div>
                    <div>
                        <a type="button" href="{{ route('laporan.cetak') }}"
                            class="mr-2 text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 font-semibold rounded-full text-md px-4 py-3">Cetak
                            Laporan</a>
                        <a type="button" href="{{ route('laporan.unduh') }}"
                            class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 font-semibold rounded-full text-md px-4 py-3">Unduh
                            Laporan</a>
                    </div>

                </div>

                <div class="mt-8 border border-gray-300 rounded-2xl">
                    <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                        <tr>
                            <th>
                                <div class="p-10 bg-white ">
                                    <h1 class="text-xl font-bold text-left">Daftar Mahasiswa</h1>
                                </div>
                            </th>
                        </tr>

                        <table class="w-full text-m text-left text-gray-700">
                            <thead class="font-bold text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                                <tr>
                                    <th scope="col" class="pl-10">No.</th>
                                    <th scope="col" class="pl-2 pr-8">
                                        <div class="flex items-center">
                                            Nama Mahasiswa
                                        </div>
                                    </th>
                                    <th scope="col" class="pr-12">NIM</th>
                                    <th scope="col" class="pl-10 pr-12">SKS Lulus</th>
                                    <th scope="col" class="px-10 py-6">IPK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($akademik as $mhs)
                                    <tr class="bg-white border-b border-gray-300">
                                        <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                                            {{ ($akademik->currentPage() - 1) * $akademik->perPage() + $loop->iteration }}.
                                        </th>
                                        <td class="pl-2 pr-8">{{ $mhs->user_name }}</td>
                                        <td class="pr-12">{{ $mhs->nim }}</td>
                                        <td class="pl-16 pr-8">{{ $mhs->totalsks }}</td>
                                        <td class="px-10 py-6">{{ $mhs->ipk }}</td>
                                    </tr>
                                @endforeach
                                @if ($akademik->total() > 10)
                                    <tr>
                                        <td colspan="6" class="p-11 py-4 border-b border-gray-300 bg-gray-100">
                                            {{ $akademik->links() }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <br><br><br>
        </div>
    </x-layout>
@elseif(in_array(auth()->user()->role, ['mahasiswa', 'superadmin']))
    <script>
        window.location.href = "{{ route('dashboard') }}";
    </script>
@endif
