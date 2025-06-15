@if (auth()->user()->role === 'admin')

    <x-layout>
        <x-slot name="title">Dashboard</x-slot>

        <div class="pl-20 px-12 pt-12 sm:ml-64 overflow-auto">

            <div class="text-3xl font-bold mb-12">Dashboard Dosen</div>
            <div class="grid grid-cols-5 grid-rows-3 gap-6 mb-8">

                <div class="col-span-3 rounded-2xl bg-teal-900 text-white shadow-sm py-6 pl-8">
                    <div class="text-xl font-bold text-left mb-4">
                        Selamat Datang, Bapak/Ibu Dosen
                    </div>
                    <div class="text-l">
                        Pantau dan tingkatkan prestasi akademik Mahasiswa Ilmu Komputer melalui SIPRESKOM </div>
                </div>

                @include('components.statusMhs')

                <div
                    class="col-span-2 row-span-3 col-start-4 bg-white shadow-sm rounded-2xl pt-8 text-left border border-gray-300">
                    <div class="text-center mb-6 text-xl font-bold">Profil Saya</div>
                    <div class="pl-12 mb-6 pr-10">
                        @include('components.profilMhs')
                    </div>
                    <div class="pl-12 pr-10">
                        @if (Auth::user()->nim == '197511212005012004')
                            <div class="mb-6 font-normal leading-7 text-ellipsis">
                                Koordinator Program Studi (Koorprodi) Ilmu Komputer
                                Fakultas Matematika dan Pengetahuan Alam
                                Universitas Negeri Jakarta
                            </div>
                        @elseif (in_array((string) Auth::user()->nim, ['196605171994031003', '198811022022031002']))
                            <div class="mb-6 font-normal leading-7 text-ellipsis">
                                Dosen Pembimbing Akademik Mahasiswa Program Studi Ilmu Komputer
                                Fakultas Matematika dan Pengetahuan Alam
                                Universitas Negeri Jakarta
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- CONTENT 2 --}}
            <div class="grid grid-cols-5 grid-rows-1 gap-6 mb-8">

                <div class="col-span-3 bg-white shadow-sm rounded-2xl border border-gray-300">
                    <div class="overflow-x-auto sm:rounded-2xl">
                        <tr>
                            <th class="h-24">
                                <div class="py-10 pl-8 bg-white border-gray-300">
                                    <div class="flex items-center gap-6 flex-wrap justify-between mx-auto">
                                        <div class="text-xl font-bold text-left">Mahasiswa Bimbingan Akademik</div>
                                        <a href="prestasi-akademik"
                                            class="transition ease-in-out duration-150 hover:bg-teal-800 text-white mr-8 bg-teal-700 font-bold rounded-full text-sm px-4 py-2 mb-1">
                                            Lihat semua
                                        </a>
                                    </div>
                                </div>
                            </th>
                        </tr>

                        <table class="w-full text-md text-left bg-teal-900 border-collapse">
                            <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                                <tr>
                                    <th class="pl-8">Nama Lengkap</th>
                                    <th class="pl-12 pr-6">NIM</th>
                                    <th class="pl-8 py-6">Total SKS</th>
                                    <th class="pl-8 pr-4">IPK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $user = Auth::user();
                                    $filteredAkademik = collect();

                                    if ($user && isset($user->nim)) {
                                        $nim = trim($user->nim);

                                        $filteredAkademik = $akademik
                                            ->filter(function ($mhs) use ($nim) {
                                                $lastDigit = intval(substr(trim($mhs->nim), -1));

                                                if ($nim === '198811022022031002') {
                                                    return $lastDigit % 2 === 0;
                                                } elseif ($nim === '196605171994031003') {
                                                    return $lastDigit % 2 !== 0;
                                                } elseif ($nim === '197511212005012004') {
                                                    return true;
                                                }
                                                return true;
                                            })
                                            ->sortBy('ipk')
                                            ->take(7);
                                    }
                                @endphp
                                @foreach ($filteredAkademik as $mhs)
                                    <tr class="bg-white border-b border-gray-300">
                                        <td class="pl-8 font-medium text-gray-900">{{ $mhs->user_name }}</td>
                                        <td class="pl-12 pr-6">{{ $mhs->nim }}</td>
                                        <td class="pl-16 py-6 ">{{ $mhs->totalsks }}</td>
                                        <td class="pl-8 pr-4">{{ $mhs->ipk }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div
                    class="col-span-2 row-span-1 col-start-4 pt-8 bg-white shadow-sm rounded-2xl text-left pl-12 pr-10 border border-gray-300">
                    <div class="text-center mb-6 text-xl font-bold">Grafik Akademik Angkatan</div>
                    <div class="my-8">
                        @php

                            $nim = $user->nim;
                            $semesterData = DB::table('akademik_semester')
                                ->where('nim', $nim)
                                ->orderBy('semester')
                                ->get();
                            $ipData = $semesterData
                                ->filter(fn($s) => $s->ip > 0)
                                ->map(function ($s) {
                                    return [
                                        'semester' => 'Semester ' . $s->semester,
                                        'ip' => $s->ip,
                                    ];
                                })
                                ->values()
                                ->toArray();

                            $totalIP = $semesterData->sum('ip');
                            $totalSKS = $semesterData->sum('sks');
                            $jumlahSemester = $semesterData->count();

                            $ipk = $jumlahSemester > 0 ? round($totalIP / $jumlahSemester, 2) : 0;
                            $totalsks = $totalSKS;

                            $distinctSemesters = DB::table('akademik_semester')
                                ->select('semester')
                                ->distinct()
                                ->pluck('semester')
                                ->sort();

                            $ipAvgData = [];
                            $ipMaxData = [];
                            $ipMinData = [];

                            foreach ($distinctSemesters as $semester) {
                                $ipValues = DB::table('akademik_semester')
                                    ->where('semester', $semester)
                                    ->where('ip', '>', 0)
                                    ->pluck('ip');

                                if ($ipValues->count() > 0) {
                                    $avg = round($ipValues->avg(), 2);
                                    $max = $ipValues->max();
                                    $min = $ipValues->min();

                                    $label = 'Semester ' . $semester;
                                    $ipAvgData[] = ['semester' => $label, 'ip' => $avg];
                                    $ipMaxData[] = ['semester' => $label, 'ip' => $max];
                                    $ipMinData[] = ['semester' => $label, 'ip' => $min];
                                }
                            }
                        @endphp
                        <x-chart-dsn :ip-avg-data="$ipAvgData" :ip-max-data="$ipMaxData" :ip-min-data="$ipMinData" />
                    </div>
                    <div
                        class="mx-4 my-8 py-6 bg-gray-100 text-black border border-gray-400 rounded-lg text-left content-center">
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
                            <div class="text-md leading-7rounded-lg px-6 py-2">
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
        </div>

        <br><br><br>
    </x-layout>
@elseif(auth()->user()->role === 'mahasiswa')
    <x-layout>
        <x-slot name="title">Dashboard</x-slot>

        <div class="pl-20 px-12 pt-12 sm:ml-64 overflow-auto">

            <div class="text-3xl font-bold mb-12">Dashboard Mahasiswa</div>


            <div class="grid grid-cols-5 grid-rows-3 gap-6 mb-8">

                <div class="col-span-3 rounded-2xl bg-teal-900 text-white shadow-sm py-6 pl-8">
                    <div class="text-xl font-bold text-left mb-4">
                        Selamat Datang, {{ Str::of($user->name)->words(2, '') }}
                    </div>
                    <div class="text-l">
                        Yuk pantau dan selalu tingkatkan prestasi akademik Anda melalui SIPRESKOM.
                    </div>
                </div>

                @include('components.statusAkademik')

                <div
                    class="col-span-2 row-span-3 col-start-4 bg-white shadow-sm rounded-2xl pt-8 text-left border border-gray-300">
                    <div class="text-center mb-6 text-xl font-bold">Profil Saya</div>
                    <div class="pl-12 mb-6 pr-10">
                        @include('components.profilMhs')
                    </div>
                    <div class="pl-12">

                        <div class="text-md font-bold mb-6">Dosen Pembimbing Akademik:</div>
                        <div class="flex gap-5 mb-8 items-center">
                            <div class="overflow-hidden bg-gray-100 rounded-full">
                                <img class="w-20"
                                    src="{{ url('storage/images/' . ($user->nim % 2 == 0 ? 'ari.png' : 'pakmul.jpg')) }}"
                                    alt="">
                            </div>
                            <div>
                                @php
                                    $nip = $user->nim % 2 == 0 ? '198811022022031002' : '196605171994031003';
                                    $dosen = DB::table('dosenPA')->where('nip', $nip)->first();
                                @endphp

                                @if ($dosen)
                                    <div class="font-bold mb-1 text-md">{{ $dosen->name }}</div>
                                    <div class="text-md text-gray-500">NIP. {{ $dosen->nip }}</div>
                                @else
                                    <div class="text-md text-gray-500">Data dosen tidak ditemukan.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CONTENT 2 --}}
            <div class="grid grid-cols-5 grid-rows-1 gap-6 mb-8">

                <div class="col-span-3 bg-white shadow-sm rounded-2xl border border-gray-300">
                    <div class="overflow-x-auto sm:rounded-2xl">
                        <tr>
                            <th class="h-24">
                                <div class="py-8 pl-8 bg-white border-gray-300">
                                    <div class="flex items-center gap-6 flex-wrap justify-between mx-auto">
                                        <div class="text-xl font-bold text-left">Riwayat Akademik</div>
                                        <a href="prestasi-akademik"
                                            class="transition ease-in-out duration-150 hover:bg-teal-800 text-white mr-8 bg-teal-700 font-bold rounded-full text-sm px-4 py-2 mb-1">
                                            Lihat semua
                                        </a>
                                    </div>
                                </div>
                            </th>
                        </tr>

                        <table class="w-full text-md text-left bg-teal-900 border-collapse">
                            <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                                <tr>
                                    <th class="pl-8">Nama Mata Kuliah</th>
                                    <th class="pl-4 py-6 pr-3">Kode MK</th>
                                    <th class="pl-12 py-6">SKS</th>
                                    <th class="pl-16 py-6">Nilai</th>
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
                                        )
                                        ->orderBy('nilai.id', 'desc')
                                        ->take(3)
                                        ->get();
                                @endphp

                                @foreach ($matkulData as $data)
                                    <tr class="bg-white border-b border-gray-300">
                                        <td class="pl-8 py-4 font-medium text-gray-900">{{ $data->nama_matkul }}</td>
                                        <td class="pl-4 py-6 pr-3">{{ $data->kode_matkul }}</td>
                                        <td class="pl-12 py-6">{{ $data->sks }}</td>
                                        <td class="pl-16 py-6">{{ $data->nilai }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div
                    class="col-span-2 row-span-1 col-start-4 pt-8 bg-white shadow-sm rounded-2xl text-left px-10 border border-gray-300">
                    <div class="text-center text-xl font-bold mb-6">Rekomendasi</div>
                    <div class="mx-1 grid gap-3">
                        @php
                            $rekomendasiList = DB::table('rekomendasis')
                                ->where('nim', $user->nim)
                                ->select('name', 'isi', 'created_at')
                                ->orderBy('created_at', 'desc')
                                ->distinct('created_at')
                                ->take(3)
                                ->get();
                        @endphp

                        @if ($rekomendasiList->isNotEmpty())
                            @foreach ($rekomendasiList as $rekomendasi)
                                <div class="font-bold text-md mt-4">{{ $rekomendasi->name }}</div>
                                <div
                                    class="flex gap-2 content-center text-md font-medium text-gray-800 w-96 items-center">
                                    <i class="fa fa-angle-double-right" style="font-size:20px;color:green"></i>
                                    {{ $rekomendasi->isi }}
                                </div>
                            @endforeach
                        @else
                            <div class="font-bold text-md text-gray-500">Rekomendasi tidak ditemukan.</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- CONTENT 3 --}}
            <div class="h-auto rounded-2xl bg-white shadow-sm border border-gray-300">
                <div class="pt-8 pb-12 text-center text-xl font-bold">Grafik Akademik</div>
                <div class="grid grid-cols-2 gap-6 pb-8 mx-12 items-center">

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
                    <div class="h-fit bg-gray-100 text-black border border-gray-400 rounded-lg p-8 text-left">
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
                                Pada <strong>{{ $lastMahasiswa['semester'] }}</strong>, IP Anda adalah
                                <strong>{{ $lastMahasiswa['ip'] }}</strong>, yang berada
                                <strong>{{ $status }}</strong> dibandingkan rata-rata IP seluruh mahasiswa yaitu
                                <strong>{{ $lastRata2['ip'] }}</strong>.
                                Tren IP mahasiswa saat ini <strong>{{ $tren }}</strong> dibandingkan semester
                                sebelumnya.
                            </div>
                        @else
                            <p>Data IP tidak cukup untuk membuat penjelasan.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <br><br><br>
    </x-layout>
@elseif(auth()->user()->role === 'superadmin')
<x-layout>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Data Dosen Berhasil Dihapus!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <x-slot name="title">
        Daftar Dosen </x-slot>

    <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
        <div class="mx-20">
            <div class="text-3xl font-bold mb-6">
                Daftar Dosen </div>

            <div class="mt-12 border border-gray-300 rounded-2xl">
                <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                    <table class="w-full text-m text-left text-gray-700">
                        <thead class="font-bold text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                            <tr>
                                <th class="pl-10 py-6">No.</th>
                                <th class="px-8 py-6">Nama Dosen</th>
                                <th class="px-4 py-6">NIP</th>
                                <th class="px-8 py-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($admin as $index => $user)
                                <tr class="border-b border-gray-300">
                                    <td class="pl-10 py-6">{{ $index + 1 }}.</td>
                                    <td class="px-8 py-6">{{ $user->name }}</td>
                                    <td class="px-4 py-6">{{ $user->nim }}</td>
                                    <td class="px-4 py-6">
                                        <form action="{{ route('hapus-mahasiswa', $user->nim) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-800 text-sm font-semibold text-white px-3 py-1 rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
</x-layout>

@endif
