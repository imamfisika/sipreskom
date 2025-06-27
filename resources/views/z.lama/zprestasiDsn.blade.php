@if (auth()->user()->role === 'admin')
    <x-layout>
        <x-slot name="title">
            Prestasi Akademik {{ $mahasiswa->nama_mahasiswa }}
        </x-slot>

        <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
            <div class="mx-20">
                <div class="text-3xl font-bold text-gray-500 mb-10 flex items-center">
                    <a href="/prestasi-akademik" class="hover:text-gray-700">Prestasi Akademik</a> <svg
                        class="rtl:rotate-180 w-3 text-gray-400 mx-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <div class="font-bold text-2xl text-black">{{ $mahasiswa->nama_mahasiswa }} / {{ $mahasiswa->nim }}
                    </div>
                </div>

                {{-- PROFIL MHS --}}
                <div class="place-items-center bg-white pt-8 pb-8 rounded-2xl border border-gray-300">
                    <div class="flex items-center justify-center">
                        <div class="w-32 overflow-hidden bg-gray-100 rounded-full">
                            <img src="{{ $mahasiswa->foto ? asset('storage/' . $mahasiswa->foto) : asset('/public/images/profil.jpg') }}"
                                class="object-cover w-full h-full aspect-square">
                        </div>
                        <div class="ml-6 leading-7 truncate overflow-hidden text-ellipsis">
                            <div class="font-bold text-gray-900">{{ $mahasiswa->nama_mahasiswa }}</div>
                            <div class="text-gray-500">{{ $mahasiswa->nim }}</div>
                            <div class="text-gray-500">Ilmu Komputer 20{{ substr($mahasiswa->nim, 5, 2) }}</div>
                            <div class="text-gray-500">{{ $mahasiswa->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="text-2xl font-bold mt-10 mb-2">Riwayat Akademik</div>
                {{-- STATUS MHS --}}
                <div class="col-span-2 row-span-2 mb-8">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center ">

                        <div
                            class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
                            <div class="w-14 h-14 bg-emerald-500 rounded-lg flex items-center justify-center mb-8">
                                <i class="fa fa-file-text" style="font-size:24px; color:white"></i>
                            </div>
                            <div class="text-xl font-bold mb-5">SKS Lulus</div>
                            <div class="flex justify-between items-center gap-4 mb-3">
                                <div class="w-full bg-gray-200 rounded-full h-4">
                                    <div class="bg-emerald-500 h-4 rounded-full"
                                        style="width:{{ min(($mahasiswa->totalsks / 144) * 100, 100) }}%">
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm font-semibold flex">
                                <div>
                                    {{ $mahasiswa->totalsks }} &nbsp
                                </div>
                                <div class="font-black text-emerald-500">/&nbsp 144</div>
                            </div>
                        </div>
                        <div
                            class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
                            <div class="w-14 h-14 bg-sky-500 rounded-lg flex items-center justify-center mb-8">
                                <i class="fa fa-bar-chart" style="font-size:24px; color:white"></i>
                            </div>
                            <div class="text-xl font-bold mb-5">IPK</div>
                            <div class="flex justify-between items-center gap-4 mb-3">
                                <div class="w-full bg-gray-200 rounded-full h-4">
                                    <div class="bg-sky-500 h-4 rounded-full"
                                        style="width: {{ ($mahasiswa->ipk / 4.0) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm font-semibold flex">
                                <div>
                                    {{ $mahasiswa->ipk }}
                                    &nbsp
                                </div>
                                <div class="font-black text-sky-500">/&nbsp 4.00</div>
                            </div>
                        </div>
                        <div
                            class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
                            <div class="w-14 h-14 bg-indigo-500 rounded-lg flex items-center justify-center mb-8">
                                <i class="fa fa-mortar-board" style="font-size:24px; color:white"></i>
                            </div>
                            <div class="text-xl font-bold mb-5">Status Akademik</div>
                            @php
                                $status = '';
                                if ($mahasiswa->ipk > 3.5) {
                                    $status = 'Berprestasi';
                                } elseif ($mahasiswa->ipk >= 3.01 && $mahasiswa->ipk <= 3.5) {
                                    $status = 'Cukup Berprestasi';
                                } else {
                                    $status = 'Kurang Berprestasi';
                                }
                            @endphp
                            <div class="text-lg text-indigo-500 font-bold mb-6">{{ $status }}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="my-8 border border-gray-300 rounded-2xl">
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
                                        </div>
                                    </th>
                                    <th scope="col" class="pr-3">Kode MK</th>
                                    <th scope="col" class="pl-10 pr-3">SKS</th>
                                    <th scope="col" class="pl-10 py-6">Bobot</th>
                                    <th scope="col" class="pl-14 py-6 pr-5">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mataKuliah as $index => $mk)
                                    <tr class="bg-white border-b border-gray-300">
                                        <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $index + 1 }}.</th>
                                        <td class="pl-2 pr-8">{{ $mk->nama_matkul }}</td>
                                        <td class="pr-3">{{ $mk->kode_matkul }}</td>
                                        <td class="pl-10 pr-3">{{ $mk->sks }}</td>
                                        <td class="pl-10 py-6">{{ $mk->bobot }}</td>
                                        <td class="pl-14 py-6">{{ $mk->nilai }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="6" class="p-11 py-4 border-b border-gray-300 bg-gray-100">
                                        {{ $mataKuliah->links() }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="bg-white pl-8 pt-8 font-medium text-lg">
                            <div class="mb-2">Jumlah SKS Lulus = {{ $mahasiswa->totalsks }} </div>
                            <div class="pb-10">Index Prestasi Kumulatif (IPK) = {{ $mahasiswa->ipk }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-10 my-8 rounded-2xl shadow-sm border border-gray-300">
                    <div class="text-2xl text-center font-bold mb-16 ">Grafik Akademik</div>
                    <div class="mx-10 my-12">
                        @php
                        $ipData = DB::table('akademik_semester')
                            ->where('nim', $mahasiswa->nim)
                            ->orderBy('semester')
                            ->get()
                            ->map(function ($item) {
                                return [
                                    'semester' => 'Semester ' . $item->semester,
                                    'ip' => $item->ip,
                                ];
                            })
                            ->filter(fn($item) => $item['ip'] > 0)
                            ->values()
                            ->toArray();

                        $ipAvgData = [];

                        $semesters = DB::table('akademik_semester')
                            ->select('semester')
                            ->distinct()
                            ->orderBy('semester')
                            ->pluck('semester');

                        foreach ($semesters as $semester) {
                            $ipValues = DB::table('akademik_semester')
                                ->where('semester', $semester)
                                ->where('ip', '>', 0)
                                ->pluck('ip');

                            if ($ipValues->count() > 0) {
                                $avg = round($ipValues->avg(), 2);
                                $ipAvgData[] = [
                                    'semester' => 'Semester ' . $semester,
                                    'ip' => $avg,
                                ];
                            }
                        }
                    @endphp
                        <x-ipk-chart :user="$user" :ip-data="$ipData" :ip-avg-data="$ipAvgData" />
                    </div>

                    <div
                        class="mx-12 pt-8 py-8 bg-gray-100 text-black border border-gray-400 rounded-lg text-left content-center">
                        <div class= "text-md mx-8 text-wrap leading-7">
                            @php
                                $lastMahasiswa = end($ipData);
                                $lastRata2 = end($ipAvgData);

                                $status = '';
                                if ($lastMahasiswa && $lastRata2) {
                                    if ($lastMahasiswa['ip'] > $lastRata2['ip']) {
                                        $status = 'di atas rata-rata';
                                    } elseif ($lastMahasiswa['ip'] < $lastRata2['ip']) {
                                        $status = 'di bawah rata-rata';
                                    } else {
                                        $status = 'sama dengan rata-rata';
                                    }
                                }

                                $tren = '';
                                if (count($ipData) >= 2) {
                                    $beforeLast = $ipData[count($ipData) - 2];
                                    if ($lastMahasiswa['ip'] > $beforeLast['ip']) {
                                        $tren = 'meningkat';
                                    } elseif ($lastMahasiswa['ip'] < $beforeLast['ip']) {
                                        $tren = 'menurun';
                                    } else {
                                        $tren = 'stabil';
                                    }
                                }
                            @endphp

                            @if ($lastMahasiswa && $lastRata2)
                                <div class="text-md leading-7">
                                    Pada <strong>{{ $lastMahasiswa['semester'] }}</strong>, IP
                                    {{ $mahasiswa->nama_mahasiswa }} adalah
                                    <strong>{{ $lastMahasiswa['ip'] }}</strong>, yang berada
                                    <strong>{{ $status }}</strong> dibandingkan rata-rata IP seluruh mahasiswa
                                    yaitu
                                    <strong>{{ $lastRata2['ip'] }}</strong>.
                                    Tren IP mahasiswa saat ini <strong>{{ $tren }}</strong> dibandingkan
                                    semester
                                    sebelumnya.
                                </div>
                            @else
                                <p>Data IP tidak cukup untuk membuat penjelasan.</p>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="flex justify-between items-center mt-4">
                    <div class="text-2xl font-bold">Rekomendasi</div>
                    <div class="text-right my-6">
                        <a type="button" href="/tambah-rekomendasi"
                            class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 font-semibold rounded-full w-1/2 text-md px-5 py-3">Tambah
                            Rekomendasi</a>
                    </div>
                </div>

                <div class="grid gap-6 mt-8">
                    @if ($rekomendasis->count() > 0)
                        <div class="overflow-x-auto">
                            <div class="flex gap-6">
                                @foreach ($rekomendasis as $createdAt => $group)
                                    <div
                                        class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 pt-6 py-8 px-8 w-1/2">
                                        <div class="border-b border-gray-300 pt-2 pb-6 flex justify-between">
                                            <div>
                                                <div class="mb-2 text-gray-400 font-semibold">
                                                    {{ $group->first()->created_at->format('d M Y') }}
                                                </div>
                                                <div class="font-bold text-xl text-black">
                                                    {{ \App\Models\Rekomendasi::where('created_at', $createdAt)->value('name') }}
                                                </div>
                                            </div>
                                            @if ($loop->first)
                                                <div>
                                                    <span
                                                        class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-4 py-1.5 rounded-md">
                                                        Terbaru
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="font-semibold text-md mt-8">Rekomendasi mata kuliah:</div>
                                        <div class="grid grid-cols-2 w-96 gap-4">
                                            @foreach ($group as $rekom)
                                                <div
                                                    class="text-center mt-4 w-48 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate overflow-hidden">
                                                    {{ $rekom->matkul_rekomendasi }}
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="font-semibold text-md mt-8 mb-4">Saran:</div>
                                        <div
                                            class="flex gap-3 content-center text-md font-medium text-gray-800 w-96 items-center">
                                            <i class="fa fa-check-square" style="font-size:20px;color:green"></i>
                                            <div> {{ $group->first()->isi }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p>Tidak ada rekomendasi yang ditemukan.</p>
                    @endif
                </div>


            </div>
        </div>


        <br><br><br>
    </x-layout>
    @elseif(in_array(auth()->user()->role, ['mahasiswa', 'superadmin']))
    <script>
        window.location.href = "{{ route('dashboard') }}";
    </script>
@endif
