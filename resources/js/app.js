import './bootstrap';



const options = {
    // set the labels option to true to show the labels on the X and Y axis
    xaxis: {
      show: true,
      categories: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7', 'Sem 8'],
      labels: {
        show: true,
        style: {
          fontFamily: "Inter, sans-serif",
          cssClass: 'text-sm font-normal fill-gray-500'
        }
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      show: true,
      labels: {
        show: true,
        style: {
          fontFamily: "Inter, sans-serif",
          cssClass: 'text-sm font-normal fill-gray-500'
        },
        formatter: function (value) {
          return value;
        }
      }
    },
    series: [
      {
        name: "Indeks Prestasi Anda",
        data: [3.6, 3.43, 3.42, 3.54, 3.61, 3.63],
        color: " #0033cc",
      },
      {
        name: "Rata-rata angkatan",
        data: [3.21, 2.89, 3.13, 3.16, 3.25, 3.41],
        color: " #ff9900",
      },
    ],
    chart: {
      sparkline: {
        enabled: false
      },
      height: "200%",
      width: "100%",
      type: "area",
      fontFamily: "Inter, sans-serif",
      dropShadow: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    tooltip: {
      enabled: true,
      x: {
        show: false,
      },
    },
    fill: {
      type: "gradient",
      gradient: {
        opacityFrom: 0.55,
        opacityTo: 0,
        shade: "#1C64F2",
        gradientToColors: ["#1C64F2"],
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 6,
    },
    legend: {
      show: false
    },
    grid: {
      show: false,
    },
    }

    if (document.getElementById("labels-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("labels-chart"), options);
    chart.render();
    }
