<div class="py-8 pb-12 items-center flex flex-col md:flex-row md:items-center justify-between">
    <div class="chart-container max-w-xl mx-auto h-96 w-4/5">
        <canvas id="grafikStatistikDosenpa"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('grafikStatistikDosenpa').getContext('2d');
        const grafik = @json($grafik);

        const labels = grafik.map(item => item.semester);
        const maxIP = grafik.map(item => item.ip_max);
        const minIP = grafik.map(item => item.ip_min);
        const avgIP = grafik.map(item => item.ip_avg);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'IP Tertinggi',
                        data: maxIP,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 3,
                        tension: 0.3
                    },
                    {
                        label: 'IP Rata-rata',
                        data: avgIP,
                        borderColor: 'rgba(255, 206, 86, 1)',
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderWidth: 3,
                        tension: 0.3
                    },
                    {
                        label: 'IP Terendah',
                        data: minIP,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 3,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 4
                    }
                }
            }
        });
    });
</script>