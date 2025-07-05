<div class="px-16 pb-12 items-center flex flex-col md:flex-row md:items-center justify-between">
    <div class="chart-container  max-w-xl mx-auto h-96 w-3/5">
        <canvas id="mhsChart-{{ $user->nim }}"></canvas>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('mhsChart-{{ $user->nim }}').getContext('2d');

                const ipData = @json($ipData);
                const avgData = @json($ipAvgData);

                const labels = ipData.map(item => item.semester);
                const mahasiswaIP = ipData.map(item => item.ip);
                const rataRataIP = avgData.map(item => item.ip);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'IP Anda',
                                data: mahasiswaIP,
                                borderColor: 'rgba(54, 162, 235, 1)',
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderWidth: 4,
                                fill: false,
                                tension: 0.3,
                            },
                            {
                                label: 'IP Rata-rata angkatan',
                                data: rataRataIP,
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderWidth: 4,
                                fill: false,
                                tension: 0.3,
                                borderDash: [5, 5]
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: 4.0
                            }
                        }
                    }
                });
            });
        </script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @if (!isset($hideDeskripsi))
        <div class="bg-gray-100 text-black border border-gray-400 rounded-lg p-6 ml-6 text-left text-sm leading-7 w-2/5">
            {!! $deskripsi !!}
        </div>
    @endif
</div>
