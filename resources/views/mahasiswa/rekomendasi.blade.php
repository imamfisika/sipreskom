@extends('layouts.app')

@section('title', 'Rekomendasi')

@section('content')

    @include('components.sidebar.mahasiswa')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-12">Rekomendasi</div>

        <div class="flex gap-4 items-center mb-8">
            <div class="text-md font-semibold">Semester:</div>
            <button
                class="justify-between mx-4 text-black bg-white border border-gray-300 w-72 rounded-lg text-sm px-4 py-3 inline-flex items-center"
                type="button">
                Semua
            </button>
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

        <div class="grid gap-6 my-8">
            <div class="overflow-x-auto">
                <div class="flex gap-6 flex-nowrap">
                    @forelse($rekomendasis as $timestamp => $group)
                        <div class="bg-white border border-gray-300 shadow-sm rounded-2xl p-8 min-w-[40%]">
                            <div class="border-b border-gray-300 pt-2 pb-6 flex justify-between">
                                <div>
                                    <div class="mb-1 text-gray-500 text-sm">
                                        {{ \Carbon\Carbon::parse($timestamp)->format('d M Y') }}
                                    </div>
                                    <div class="font-bold text-lg"> {{ $group->first()->nama_dosen }}
                                    </div>
                                </div>
                                <div>
                                    @if ($loop->first)
                                        <div
                                            class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1.5 rounded-md item">
                                            Terbaru
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6 font-semibold text-sm">Rekomendasi Mata Kuliah:</div>
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach($group as $rekom)
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm border border-indigo-500">
                                    {{ $rekom->matkul->nama_matkul ?? '-' }}
                                </span>
                            @endforeach
                            </div>

                            <div class="mt-10 font-semibold mb-2 text-sm">Saran:</div>
                            <div class="flex items-center gap-2 text-sm text-gray-800">
                                <i class="fa fa-check-square text-green-600"></i>
                                <div>{{ $group->first()->keterangan }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500 text-md text-center">Belum ada rekomendasi dari Dosen Pembimbing Akademik.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
