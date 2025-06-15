@if (auth()->user()->role === 'admin')
    <x-layout>
        <x-slot name="title">
            Prestasi Akademik
        </x-slot>

        <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
            <div class="mx-20">
                <div class="text-3xl font-bold mb-6">
                    Prestasi Akademik
                </div>
                <div class="col-span-2 row-span-2  mb-8">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center ">
                        @include('components.statusMhs')

                    </div>
                </div>
                <hr class="h-px my-12 bg-gray-300 border-0">


                <div class="flex items-center justify-between">
                    <div class="flex gap-4 items-center">
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
                    @if (request('search'))
                        @php
                            $mahasiswa = DB::table('users')
                                ->where('role', 'mahasiswa')
                                ->where(function ($query) {
                                    $query
                                        ->where('name', 'like', '%' . request('search') . '%')
                                        ->orWhere('nim', 'like', '%' . request('search') . '%');
                                })
                                ->first();
                        @endphp
                        @if ($mahasiswa)
                            <script>
                                window.location.href = "{{ route('prestasi-akademik-mahasiswa', ['nim' => $mahasiswa->nim]) }}";
                            </script>
                        @else
                            <div class="text-red-500 w-36 mr-4 text-right">Mahasiswa tidak ditemukan.</div>
                        @endif
                    @endif
                    <form method="GET" action="{{ route('prestasi-akademik') }}" class="flex items-center w-1/2">
                        <input type="text" name="search" placeholder="Ketik Nama/Nomor Induk Mahasiswa"
                            value="{{ request('search') }}"
                            class="flex-wrap justify-between mx-auto mr-3 text-black bg-white border border-gray-300 w-full rounded-lg text-md px-5 py-3 inline-flex items-center">
                        <button type="submit"
                            class="px-5 py-3 hover:bg-teal-900 bg-teal-700 text-white rounded-lg text-md font-semibold">Cari</button>
                    </form>


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
                                    <th scope="col" class="pr-3">NIM</th>
                                    <th scope="col" class="pl-10 pr-3">SKS Lulus</th>
                                    <th scope="col" class="pl-10 py-6">IPK</th>
                                    <th scope="col" class="pl-14 py-6 pr-5">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $user = Auth::user();
                                    $filter = '';

                                    if ($user) {
                                        $nim = trim($user->nim);

                                        if ($nim === '196605171994031003') {
                                            $filter = 'Menampilkan mahasiswa dengan NIM ganjil';
                                        } elseif ($nim === '198811022022031002') {
                                            $filter = 'Menampilkan mahasiswa dengan NIM genap';
                                        } elseif ($nim === '197511212005012004') {
                                            $filter = 'Menampilkan seluruh data mahasiswa';
                                        } else {
                                            $filter = 'Menampilkan semua mahasiswa';
                                        }
                                    }

                                    $sortedAkademik = $akademik->sortBy('ipk');
                                @endphp
                                @foreach ($sortedAkademik as $mhs)
                                    <tr class="bg-white border-b border-gray-300">
                                        <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                                            {{ ($akademik->currentPage() - 1) * $akademik->perPage() + $loop->iteration }}.
                                        </th>
                                        <td class="pl-2 pr-8">{{ $mhs->user_name }}</td>
                                        <td class="pr-3">{{ $mhs->nim }}</td>
                                        <td class="pl-16 ">{{ $mhs->totalsks }}</td>
                                        <td class="pl-10 py-6">{{ $mhs->ipk }}</td>
                                        <td class="pl-14 py-6 underline-offset-3 underline text-blue-600">
                                            <a
                                                href="{{ route('prestasi-akademik-mahasiswa', ['nim' => $mhs->nim]) }}">detail</a>
                                        </td>
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

                <div class="bg-white p-10 rounded-2xl my-8 shadow-sm border border-gray-300">
                    <div class="text-2xl text-center font-bold ml-12 mb-12">Grafik Akademik Angkatan</div>
                    <div class="mx-10 my-12">

                        @php

                            $nim = $user->nim;
                            $akademikSemester = DB::table('akademik_semester')
                                ->where('nim', $nim)
                                ->orderBy('semester')
                                ->get();
                            $ipData = [];
                            $totalIp = 0;
                            $totalSks = 0;

                            foreach ($akademikSemester as $row) {
                                if ($row->ip > 0) {
                                    $ipData[] = [
                                        'semester' => "Semester $row->semester",
                                        'ip' => $row->ip,
                                    ];
                                    $totalIp += $row->ip;
                                }

                                if ($row->sks > 0) {
                                    $totalSks += $row->sks;
                                }
                            }

                            $lastSemester = $akademikSemester->max('semester');
                            $ipk = $lastSemester > 0 ? round($totalIp / $lastSemester, 2) : 0;

                            $allAkademikSemester = DB::table('akademik_semester')->get();

                            $ipAvgData = [];
                            $ipMaxData = [];
                            $ipMinData = [];

                            for ($i = 1; $i <= 14; $i++) {
                                $values = $allAkademikSemester
                                    ->where('semester', $i)
                                    ->pluck('ip')
                                    ->filter(fn($val) => $val > 0)
                                    ->all();

                                if (count($values) > 0) {
                                    $avg = round(array_sum($values) / count($values), 2);
                                    $max = max($values);
                                    $min = min($values);

                                    $ipAvgData[] = ['semester' => "Semester $i", 'ip' => $avg];
                                    $ipMaxData[] = ['semester' => "Semester $i", 'ip' => $max];
                                    $ipMinData[] = ['semester' => "Semester $i", 'ip' => $min];
                                }
                            }
                        @endphp
                        <x-chart-dsn :ip-avg-data="$ipAvgData" :ip-max-data="$ipMaxData" :ip-min-data="$ipMinData" />

                    </div>
                    @php
                        $lastAvg = end($ipAvgData);
                        $lastMax = end($ipMaxData);
                        $lastMin = end($ipMinData);

                        $tren = '';

                        if (count($ipAvgData) >= 2) {
                            $beforeLastAvg = $ipAvgData[count($ipAvgData) - 2];
                            if ($lastAvg['ip'] > $beforeLastAvg['ip']) {
                                $tren = 'meningkat';
                            } elseif ($lastAvg['ip'] < $beforeLastAvg['ip']) {
                                $tren = 'menurun';
                            } else {
                                $tren = 'stabil';
                            }
                        }
                    @endphp
                    @if ($lastAvg && $lastMax && $lastMin)
                        <div class="text-md leading-7 bg-gray-100 rounded-lg p-8 border border-gray-300">
                            Pada <strong>{{ $lastAvg['semester'] }}</strong>, IP rata-rata mahasiswa adalah
                            <strong>{{ $lastAvg['ip'] }}</strong>. Nilai IP tertinggi mencapai
                            <strong>{{ $lastMax['ip'] }}</strong>, sedangkan IP terendah adalah
                            <strong>{{ $lastMin['ip'] }}</strong>. Tren rata-rata IP mahasiswa
                            <strong>{{ $tren }}</strong> dibandingkan semester sebelumnya.
                        </div>
                    @else
                        <p>Data IP tidak cukup untuk membuat penjelasan grafik IP seluruh mahasiswa.</p>
                    @endif
                </div>
            </div>
        </div>
        <br><br><br>
    </x-layout>
@elseif(auth()->user()->role === 'mahasiswa')
    <x-layout>
        <x-slot name="title">
            Prestasi Akademik
        </x-slot>

        <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
            <div class="mx-20">
                <div class="text-3xl font-bold mb-6">
                    Prestasi Akademik
                </div>
                <div class="col-span-2 row-span-2 mb-8">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center ">
                        @include('components.statusAkademik')

                    </div>
                </div>

                <div class="text-2xl w-fit font-bold mt-10 mb-8">Riwayat Akademik</div>
                <div class="mt-8 border border-gray-300 rounded-2xl">
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
                                @php
                                    $matkulData = DB::table('matkul')
                                        ->join('nilai', 'matkul.kode_matkul', '=', 'nilai.kode_matkul')
                                        ->where('nilai.nim', $user->nim)
                                        ->select(
                                            'matkul.nama_matkul',
                                            'matkul.kode_matkul',
                                            'matkul.sks',
                                            'nilai.nilai',
                                            'nilai.bobot',
                                        )
                                        ->paginate(10);
                                @endphp
                                @foreach ($matkulData as $data)
                                    <tr class="bg-white border-b border-gray-300">
                                        <th scope="row" class="pl-12 font-medium text-gray-900 whitespace-nowrap">
                                            {{ ($matkulData->currentPage() - 1) * $matkulData->perPage() + $loop->iteration }}.
                                        </th>
                                        <td class="pl-3 py-4 font-medium text-gray-900">{{ $data->nama_matkul }}</td>
                                        <td class="py-4">{{ $data->kode_matkul }}</td>
                                        <td class="pl-12 py-6">{{ $data->sks }}</td>
                                        <td class="pl-12 py-6">{{ $data->bobot }}</td>
                                        <td class="pl-16 py-6">{{ $data->nilai }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="p-11 py-4 border-b border-gray-300 bg-gray-100">
                                        {{ $matkulData->links() }}
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                        <div class="bg-white pl-8 pt-8 font-medium text-lg">
                            @php
                                $user = Auth::user();

                                $semesterData = DB::table('akademik_semester')
                                    ->where('nim', $user->nim)
                                    ->get(['sks', 'ip', 'semester']);

                                $totalsks = $semesterData->sum('sks');

                                $totalIp = $semesterData->sum('ip');
                                $semesterTerakhir = $semesterData->max('semester');

                                $ipk = $semesterTerakhir > 0 ? round($totalIp / $semesterTerakhir, 2) : null;
                            @endphp
                            <div class="mb-2">Jumlah SKS Lulus = {{ $totalsks }}</div>
                            <div class="pb-10">Index Prestasi Kumulatif (IPK) = {{ $ipk }}</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-10 my-8 rounded-2xl shadow-sm border border-gray-300">
                    <div class="text-2xl text-center font-bold mb-16 ">Grafik Akademik</div>
                    <div class="mx-10 my-12">
                        @php
                            $ipData = DB::table('akademik_semester')
                                ->where('nim', $user->nim)
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
                        <div class= "text-md mx-8 text-wrap leading-7">@php
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
                                    Pada <strong>{{ $lastMahasiswa['semester'] }}</strong>, IP Anda adalah
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
            </div>
        </div>
        <br><br><br>
    </x-layout>
@elseif(auth()->user()->role === 'superadmin')
    <script>
        window.location.href = "{{ route('dashboard') }}";
    </script>
@endif
