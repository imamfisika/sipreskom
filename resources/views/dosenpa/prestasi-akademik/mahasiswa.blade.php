@extends('layouts.app')

@section('title', 'Prestasi Akademik - Mahasiswa')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="mx-32">
        <div class="text-3xl font-bold text-gray-500 mb-12 flex items-center">
            <a href="{{ route('dosenpa.prestasi-akademik.index') }}" class="hover:text-gray-700">Prestasi Akademik</a> <svg
                class="rtl:rotate-180 w-3 text-gray-400 mx-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="m1 9 4-4-4-4" />
            </svg>
            <div class="font-extrabold text-3xl text-black">John Doe / 123456789</div>
        </div>

        <div class="place-items-center bg-white py-8 rounded-2xl border border-gray-300">
            <div class="flex items-center justify-center">
                <div class="w-32 overflow-hidden bg-gray-100 rounded-full">
                    <img src="{{ asset('/public/images/profil.jpg') }}" class="object-cover w-full h-full aspect-square">
                </div>
                <div class="ml-6 leading-7 truncate overflow-hidden text-ellipsis">
                    <div class="font-bold text-gray-900">John Doe</div>
                    <div class="text-gray-500">123456789</div>
                    <div class="text-gray-500">Ilmu Komputer 2020</div>
                    <div class="text-gray-500">johndoe@example.com</div>
                </div>
            </div>
        </div>

        <div class="text-2xl font-bold mt-8 mb-2">Riwayat Akademik</div>
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
                            <div class="bg-emerald-500 h-4 rounded-full" style="width:75%"></div>
                        </div>
                    </div>
                    <div class="text-sm font-semibold flex">
                        <div>108 &nbsp</div>
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
                            <div class="bg-sky-500 h-4 rounded-full" style="width:87.5%"></div>
                        </div>
                    </div>
                    <div class="text-sm font-semibold flex">
                        <div>3.5 &nbsp</div>
                        <div class="font-black text-sky-500">/&nbsp 4.00</div>
                    </div>
                </div>
                <div
                    class="row-span-2 row-start-2 bg-white shadow-sm rounded-2xl place-content-center text-left p-8 border border-gray-300">
                    <div class="w-14 h-14 bg-indigo-500 rounded-lg flex items-center justify-center mb-8">
                        <i class="fa fa-mortar-board" style="font-size:24px; color:white"></i>
                    </div>
                    <div class="text-xl font-bold mb-5">Status Akademik</div>
                    <div class="text-lg text-indigo-500 font-bold mb-6">Berprestasi</div>
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
                        <tr class="bg-white border-b border-gray-300">
                            <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">1.</th>
                            <td class="pl-2 pr-8">Pemrograman Web</td>
                            <td class="pr-3">IF123</td>
                            <td class="pl-10 pr-3">3</td>
                            <td class="pl-10 py-6">4</td>
                            <td class="pl-14 py-6">A</td>
                        </tr>
                        <tr class="bg-white border-b border-gray-300">
                            <th scope="row" class="pl-10 font-medium text-gray-900 whitespace-nowrap">2.</th>
                            <td class="pl-2 pr-8">Basis Data</td>
                            <td class="pr-3">IF124</td>
                            <td class="pl-10 pr-3">3</td>
                            <td class="pl-10 py-6">3.5</td>
                            <td class="pl-14 py-6">B+</td>
                        </tr>
                        {{-- <tr>
                            <td colspan="6" class="p-11 py-4 border-b border-gray-300 bg-gray-100">
                                <div class="text-center">Pagination</div>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
                <div class="bg-white pl-8 pt-8 font-medium text-lg">
                    <div class="mb-2">Jumlah SKS Lulus = 108 </div>
                    <div class="pb-10">Index Prestasi Kumulatif (IPK) = 3.5</div>
                </div>
            </div>
        </div>

        <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 p-8">
            <div class="text-center font-bold text-xl text-black mb-10">
                Prediksi Indeks Prestasi</div>
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
                        <strong> Prediksi IP Semester 5 :</strong> 3.9
                    </div>
                    <div class="mb-3"> <strong>Kategori Prestasi:</strong> Sangat Baik
                    </div>
                    <div class="alert alert-warning">
                        <div class="font-bold text-black mb-3">Mata Kuliah Dibawah Nilai Aman :</div>
                        <ul>
                            <li class="mb-2 font-normal">
                                <span style="color: red;">
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
                <a type="button" href="{{ route('dosenpa.rekomendasi.tambah') }}"
                class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full w-1/2 px-5 py-2.5">Tambah
                    Rekomendasi</a>
            </div>
        </div>

        <div class="grid gap-6 mt-8">
            <div class="overflow-x-auto">
                <div class="flex gap-6">
                    <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 pt-6 py-8 px-8 w-1/2">
                        <div class="border-b border-gray-300 pt-2 pb-6 flex justify-between">
                            <div>
                                <div class="mb-2 text-gray-400 font-semibold">
                                    01 Jan 2023
                                </div>
                                <div class="font-bold text-xl text-black">
                                    Rekomendasi 1
                                </div>
                            </div>
                            <div>
                                <span class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-4 py-1.5 rounded-md">
                                    Terbaru
                                </span>
                            </div>
                        </div>

                        <div class="font-semibold text-md mt-8">Rekomendasi mata kuliah:</div>
                        <div class="grid grid-cols-2 w-96 gap-4">
                            <div
                                class="text-center mt-4 w-48 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate overflow-hidden">
                                Pemrograman Lanjut
                            </div>
                            <div
                                class="text-center mt-4 w-48 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate overflow-hidden">
                                Sistem Operasi
                            </div>
                        </div>

                        <div class="font-semibold text-md mt-8 mb-4">Saran:</div>
                        <div class="flex gap-3 content-center text-md font-medium text-gray-800 w-96 items-center">
                            <i class="fa fa-check-square" style="font-size:20px;color:green"></i>
                            <div> Tingkatkan pemahaman pada mata kuliah inti.</div>
                        </div>
                    </div>

                    <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 pt-6 py-8 px-8 w-1/2">
                        <div class="border-b border-gray-300 pt-2 pb-6 flex justify-between">
                            <div>
                                <div class="mb-2 text-gray-400 font-semibold">
                                    15 Feb 2023
                                </div>
                                <div class="font-bold text-xl text-black">
                                    Rekomendasi 2
                                </div>
                            </div>
                            <div>
                                <span class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-4 py-1.5 rounded-md">
                                    Terbaru
                                </span>
                            </div>
                        </div>

                        <div class="font-semibold text-md mt-8">Rekomendasi mata kuliah:</div>
                        <div class="grid grid-cols-2 w-96 gap-4">
                            <div
                                class="text-center mt-4 w-48 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate overflow-hidden">
                                Jaringan Komputer
                            </div>
                            <div
                                class="text-center mt-4 w-48 bg-indigo-100 text-indigo-800 text-sm font-medium px-4 py-0.5 rounded-full border border-indigo-500 truncate overflow-hidden">
                                Keamanan Informasi
                            </div>
                        </div>

                        <div class="font-semibold text-md mt-8 mb-4">Saran:</div>
                        <div class="flex gap-3 content-center text-md font-medium text-gray-800 w-96 items-center">
                            <i class="fa fa-check-square" style="font-size:20px;color:green"></i>
                            <div> Fokus pada penguasaan konsep jaringan dan keamanan.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
