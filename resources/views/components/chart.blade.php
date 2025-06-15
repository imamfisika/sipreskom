<div class="chart-container w-full max-w-xl mx-auto h-96">

    <canvas id="mhsChart-{{ $user->nim }}"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
                    datasets: [
                        {
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