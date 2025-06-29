@extends('layouts.app')

@section('title', 'Prestasi Akademik - Mahasiswa')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="mx-32">
        <div class="text-3xl font-bold text-gray-500 mb-12 flex items-center">
            <a href="{{ route('dosenpa.prestasi-akademik.index') }}" class="hover:text-gray-700">Prestasi Akademik</a>
            <svg class="rtl:rotate-180 w-3 text-gray-400 mx-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="m1 9 4-4-4-4" />
            </svg>
            <div class="font-extrabold text-3xl text-black">{{ $mahasiswa->nama }}</div>
        </div>

        <div class="bg-white shadow-sm rounded-2xl border border-gray-300">
            <div class="border-gray-300 pt-10 py-4 grid place-items-center">
                <div class="pl-12 mb-6 pr-10">
                    <div class="flex items-center">
                        <div class="w-32 overflow-hidden bg-gray-100 rounded-full">
                            <img src="{{ $mahasiswa->foto ? asset('storage/' . $mahasiswa->foto) : asset('images/profil.png') }}"
                                class="object-cover w-full bg-gray-300 h-full aspect-square">
                        </div>
                        <div class="ml-8 truncate overflow-hidden text-ellipsis">
                            <div class="mb-1 font-semibold text-gray-900">{{ $mahasiswa->nama }}</div>
                            <div class="mb-1 text-sm text-gray-600">{{ $mahasiswa->nim }}</div>
                            <div class="mb-1 text-sm text-gray-600">Ilmu Komputer {{ '20' . substr($mahasiswa->nim, 5, 2) }}
                            </div>
                            <div class="mb-1 text-sm text-gray-600 truncate">{{ $mahasiswa->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-2xl w-fit font-semibold mt-8">Riwayat Akademik</div>
        <div class="col-span-2 row-span-2 mb-8">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center">
                <div
                    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300 w-full">
                    <div class="w-14 h-14 bg-emerald-500 rounded-lg flex items-center justify-center mb-8">
                        <i class="fa fa-file-text" style="font-size:24px; color:white"></i>
                    </div>
                    <div class="text-lg font-semibold mb-5">Total SKS</div>
                    <div class="flex justify-between items-center gap-4 mb-3">
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-emerald-500 h-4 rounded-full"
                                style="width:{{ min(($ipksks['total_sks'] / 144) * 100, 100) }}%">
                            </div>
                        </div>
                    </div>
                    <div class="text-sm flex">
                        <div>
                            {{ $ipksks['total_sks'] ?? '-' }}
                            &nbsp
                        </div>
                        <div class="font-bold text-emerald-500">/&nbsp 144</div>
                    </div>
                </div>
                <div
                    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300 w-full">
                    <div class="w-14 h-14 bg-sky-500 rounded-lg flex items-center justify-center mb-8">
                        <i class="fa fa-bar-chart" style="font-size:24px; color:white"></i>
                    </div>
                    <div class="text-lg font-semibold mb-5">IPK</div>
                    <div class="flex justify-between items-center gap-4 mb-3">
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-sky-500 h-4 rounded-full" style="width: {{ ($ipksks['ipk'] / 4.0) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    <div class="text-sm flex">
                        <div>
                            {{ $ipksks['ipk'] ?? '-' }}
                            &nbsp
                        </div>
                        <div class="font-bold text-sky-500">/&nbsp 4.00</div>
                    </div>
                </div>
                <div
                    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300 w-full">
                    <div class="w-14 h-14 bg-indigo-500 rounded-lg flex items-center justify-center mb-8">
                        <i class="fa fa-mortar-board" style="font-size:24px; color:white"></i>
                    </div>
                    <div class="text-lg font-semibold mb-5">Status Akademik</div>
                    <div class="w-max text-lg text-indigo-500 font-bold mb-6">Berprestasi</div>
                </div>
            </div>
        </div>

        <div class="my-8 border border-gray-300 rounded-2xl">
            <div class="overflow-x-auto sm:rounded-2xl">
                <div class="p-10 bg-white border-b border-gray-300 rounded-t-2xl">
                    <h1 class="text-lg font-bold text-left">Daftar Mata Kuliah</h1>
                </div>
                <table class="w-full text-sm text-left bg-teal-900 border-collapse">
                    <thead class="font-black text-gray-200 border-b border-t border-gray-400">
                        <tr>
                            <th scope="col" class="pl-10">No.</th>
                            <th class="pl-8">Nama Mata Kuliah</th>
                            <th class="px-4 py-4">Kode MK</th>
                            <th class="pl-12 py-4 text-center">SKS</th>
                            <th class="pl-12 py-4 text-center">Bobot</th>
                            <th class="px-10 py-4 text-center">Nilai</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($riwayatAkademik as $index => $item)
                            <tr class="bg-white border-b border-gray-300">
                                <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $index + 1 }}.</th>
                                <td class="pl-8 font-medium text-gray-900">{{ $item->nama_matkul }}</td>
                                <td class="px-4 py-4">{{ $item->kode_matkul }}</td>
                                <td class="pl-12 py-4 text-center">{{ $item->jml_sks }}</td>
                                <td class="pl-12 py-4 text-center">{{ $item->bobot }}</td>
                                <td class="px-10 py-4 text-center">{{ $item->nilai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="bg-white px-8 py-8 text-base font-semibold">
                    <div class="mb-2">Jumlah SKS Lulus = {{ $ipksks['total_sks'] }}</div>
                    <div">Index Prestasi Kumulatif (IPK) = {{ $ipksks['ipk'] }}
                </div>
            </div>
        </div>


        <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 p-8">
            <div class="text-center font-bold text-xl text-black mb-10">Prediksi Indeks Prestasi</div>
            <div class="grid grid-cols-2 items-center justify-between">
                <div class="bg-white p-8">
                    <div class="chart-container w-full max-w-5xl mx-auto">
                        <canvas id="ipChart" class="h-[400px] w-full"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const labels = ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4'];
                                const ipHistory = [3.2, 3.4, 3.6, 3.8];

                                const datasets = [{
                                    label: 'IP Anda',
                                    data: ipHistory,
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderWidth: 4,
                                    fill: false,
                                    tension: 0.1
                                }];

                                labels.push('Semester 5');
                                const prediksi = [...ipHistory, 3.9];

                                datasets.push({
                                    label: 'Prediksi IP',
                                    data: prediksi,
                                    borderColor: 'red',
                                    backgroundColor: 'red',
                                    borderWidth: 4,
                                    fill: false,
                                    borderDash: [5, 5],
                                    tension: 0.1
                                });

                                const ctx = document.getElementById('ipChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: datasets
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function(context) {
                                                        return 'IP: ' + context.parsed.y.toFixed(2);
                                                    }
                                                }
                                            }
                                        },
                                        scales: {
                                            y: {
                                                min: 0,
                                                max: 4,
                                                title: {
                                                    display: true,
                                                    text: 'IP'
                                                }
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="row-span-3 px-10 h-full content-center">
                    <div class="mb-3">
                        <strong>Prediksi IP Semester 5:</strong> 3.9
                    </div>
                    <div class="mb-3">
                        <strong>Kategori Prestasi:</strong> Sangat Baik
                    </div>
                    <div class="alert alert-warning">
                        <div class="font-bold text-black mb-3">Mata Kuliah Dibawah Nilai Aman:</div>
                        <ul>
                            <li class="mb-2 font-normal">
                                <span class="text-red-500">
                                    Matematika Lanjut (MATH202):
                                    <strong>C</strong> —
                                    <em>Wajib Diulang</em>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center pt-8 pb-2">
            <div class="text-2xl font-bold mr-6">Rekomendasi</div>
            <div class="text-right">
                <a href="{{ route('dosenpa.rekomendasi.tambah') }}"
                    class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full px-5 py-2.5">
                    Tambah Rekomendasi
                </a>
            </div>
        </div>

        <div class="grid gap-6 mt-8">
            <div class="overflow-x-auto">
                <div class="flex gap-6">
                    <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 pt-6 py-8 px-8 w-1/2">
                        <div class="border-b border-gray-300 pt-2 pb-6 flex justify-between">
                            <div>
                                <div class="mb-2 text-gray-400 font-semibold">01 Jan 2023</div>
                                <div class="font-bold text-xl text-black">Rekomendasi 1</div>
                            </div>
                            <div>
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-4 py-1.5 rounded-md">Terbaru</span>
                            </div>
                        </div>
                        <div class="font-semibold text-md mt-8">Rekomendasi mata kuliah:</div>
                        <div class="grid grid-cols-2 w-96 gap-4">
                            <div
                                class="text-center mt-4 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate">
                                Pemrograman Lanjut
                            </div>
                            <div
                                class="text-center mt-4 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate">
                                Sistem Operasi
                            </div>
                        </div>
                        <div class="font-semibold text-md mt-8 mb-4">Saran:</div>
                        <div class="flex gap-3 items-center text-md font-medium text-gray-800">
                            <i class="fa fa-check-square text-green-500 text-lg"></i>
                            <div>Tingkatkan pemahaman pada mata kuliah inti.</div>
                        </div>
                    </div>

                    <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 pt-6 py-8 px-8 w-1/2">
                        <div class="border-b border-gray-300 pt-2 pb-6 flex justify-between">
                            <div>
                                <div class="mb-2 text-gray-400 font-semibold">15 Feb 2023</div>
                                <div class="font-bold text-xl text-black">Rekomendasi 2</div>
                            </div>
                            <div>
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-4 py-1.5 rounded-md">Terbaru</span>
                            </div>
                        </div>
                        <div class="font-semibold text-md mt-8">Rekomendasi mata kuliah:</div>
                        <div class="grid grid-cols-2 w-96 gap-4">
                            <div
                                class="text-center mt-4 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate">
                                Jaringan Komputer
                            </div>
                            <div
                                class="text-center mt-4 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate">
                                Keamanan Informasi
                            </div>
                        </div>
                        <div class="font-semibold text-md mt-8 mb-4">Saran:</div>
                        <div class="flex gap-3 items-center text-md font-medium text-gray-800">
                            <i class="fa fa-check-square text-green-500 text-lg"></i>
                            <div>Fokus pada penguasaan konsep jaringan dan keamanan.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
