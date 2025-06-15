<div class="chart-container w-full max-w-xl mx-auto h-96">

    <canvas id="dsnChart"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('dsnChart').getContext('2d');

            const ipAvgData = @json($ipAvgData);
            const ipMaxData = @json($ipMaxData);
            const ipMinData = @json($ipMinData);

            const labels = ipAvgData.map(item => item.semester);

            const rataRataIP = ipAvgData.map(item => item.ip);
            const maxIP = ipMaxData.map(item => item.ip);
            const minIP = ipMinData.map(item => item.ip);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'IP Rata-rata angkatan',
                            data: rataRataIP,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderWidth: 4,
                            fill: false,
                            tension: 0.3,
                        },
                        {
                            label: 'IP Tertinggi',
                            data: maxIP,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 4,
                            fill: false,
                            tension: 0.3,
                            borderDash: [5, 5]
                        },
                        {
                            label: 'IP Terendah',
                            data: minIP,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderWidth: 4,
                            fill: false,
                            tension: 0.3,
                            borderDash: [10, 5]
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