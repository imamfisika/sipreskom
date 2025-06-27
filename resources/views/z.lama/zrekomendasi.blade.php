@if (auth()->user()->role === 'admin')
    <x-layout>
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Rekomendasi Berhasil Dikirim!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
            <x-slot name="title">
                Rekomendasi </x-slot>

            <div class="mx-20">
                <div class="flex justify-between items-center">
                    <div class="text-3xl font-bold">
                        Rekomendasi </div>
                    <div class="text-right">
                        <a type="button" href="/tambah-rekomendasi"
                            class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 font-semibold rounded-full w-1/2 text-md px-5 py-3">Tambah
                            Rekomendasi</a>
                    </div>
                </div>

                <div class="my-8 border border-gray-300 rounded-2xl mt-12">
                    <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                        <tr>
                            <th>
                                <div class="flex bg-white items-center justify-between py-12 px-10">
                                    <div class="text-xl font-bold text-left">Daftar Rekomendasi Terakhir</div>

                                </div>
                            </th>
                        </tr>

                        <table class="w-full text-m text-left text-gray-700">
                            <thead class="font-bold text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                                <tr>
                                    <th class="pl-8 pr-1 border-b py-6">Tanggal</th>
                                    <th class="pl-12 pr-4 border-b">Mahasiswa</th>
                                    <th class="pl-6 border-b">Dosen</th>
                                    <th class="pl-20 border-b">Rekomendasi Mata Kuliah</th>
                                    <th class="pl-16 pr-4 border-b">Saran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekomendasis as $createdAt => $group)
                                    <tr class="border-b bg-white">
                                        <td class="pl-8 pr-1 py-10 text-sm text-gray-600">
                                            {{ $group->first()->created_at->format('d M Y') }}
                                        </td>
                                        <td class="pl-12 pr-2 font-semibold">
                                            {{ $group->first()->mahasiswa_name }}
                                        </td>
                                        <td class="pl-6">
                                            {{ $group->first()->name }}
                                        </td>
                                        <td class="pl-20">
                                            <div class="flex flex-wrap gap-2">
                                                @foreach ($group as $rekom)
                                                    <span
                                                        class="max-w-48 truncate bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full border border-indigo-500">
                                                        {{ $rekom->matkul_rekomendasi }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="pl-16 pr-8 text-gray-800">
                                            <div class="flex items-center gap-2">
                                                <i class="fa fa-check-square" style="font-size:18px; color:green;"></i>
                                                <span>{{ $group->first()->isi }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br><br><br>
    </x-layout>
@elseif(auth()->user()->role === 'mahasiswa')
    <x-layout>
        <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
            <x-slot name="title">
                Rekomendasi </x-slot>

            <div class="mx-20">
                <div class="text-3xl font-bold mb-12">
                    Rekomendasi </div>

                <div class="flex items-center mb-8">
                    <div class="text-md font-semibold">Semester: </div>
                    <button id="dropdownHoverButton" data-dropdown-toggle="dropdown"
                        class="justify-between mx-4 text-black bg-white border border-gray-300 w-96 rounded-lg text-md px-5 py-3 inline-flex items-center"
                        type="button">Semua<svg class="w-2.5 h-2.5 " aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                </div>
                <div class="text-left bg-white shadow-sm rounded-2xl border border-gray-300 pt-8 p-8">
                    <div class="text-center font-bold text-xl text-black mb-10">
                        Prediksi IP menggunakan Prediksi Naive Bayes</div>
                    <div class="grid grid-cols-2 items-center justify-between">
                        <div class="bg-white p-8">
                            @if (!empty($ipData))
                                <div class="chart-container w-full max-w-5xl mx-auto">
                                    <canvas id="ipChart" class="h-[400px] w-full"></canvas>
                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                            const labels = @json(array_column($ipData, 'semester'));
                                            const ipHistory = @json(array_column($ipData, 'ip'));

                                            const datasets = [{
                                                label: 'IP Anda',
                                                data: ipHistory,
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                borderWidth: 4,
                                                fill: false,
                                                tension: 0.1
                                            }];

                                            @if ($predictedIp !== null)
                                                labels.push('Semester {{ $nextSemester }}');

                                                const prediksi = [...ipHistory, {{ $predictedIp }}];

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
                                            @endif

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
                            @endif
                        </div>
                        <div class="row-span-3 px-10 h-full content-center">
                            @if (isset($predictedIpBayes))
                                @if ($predictedIp !== null)
                                    <div class="mb-3">
                                        <strong> Prediksi IP Semester {{ $nextSemester }} :</strong>
                                        {{ $predictedIpBayes }}
                                    </div>
                                    <div class="mb-3"> <strong>Kategori Prestasi:</strong> {{ $prediksiKategori }}
                                    </div>
                                @endif
                            @endif

                            @if (!empty($ulangMatkul))
                                <div class="alert alert-warning">
                                    <div class="font-bold text-black mb-3">Mata Kuliah Dibawah Nilai Aman :</div>
                                    <ul>
                                        @foreach ($ulangMatkul as $matkul)
                                            <li class="mb-2 font-normal">
                                                <span @if ($matkul['status'] === 'Wajib Diulang') style="color: red;" @endif>
                                                    {{ $matkul['nama_matkul'] }} ({{ $matkul['kode_matkul'] }}):
                                                    <strong>{{ $matkul['nilai'] }}</strong> —
                                                    <em>{{ $matkul['status'] }}</em>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="font-bold text-black mb-4">Mata Kuliah yang Harus Diulang:</div>

                                <p class="text-red-600 italic">Tidak ada mata kuliah yang harus diulang!</p>
                            @endif
                        </div>
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
                                                    {{ \App\Models\Rekomendasi::where('created_at', $createdAt)->value('name') ?? 'Dosen Tidak Diketahui' }}
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
            <br><br><br>
    </x-layout>
@endif
