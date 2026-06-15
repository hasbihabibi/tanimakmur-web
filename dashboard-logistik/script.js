const lineCtx = document.getElementById('lineChart');

new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: lineLabel,
        datasets: [{
            label: 'Total Panen (Kg)',
            data: lineData,
            borderColor: '#2f8f3d',
            backgroundColor: 'rgba(47,143,61,0.2)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

const doughnutCtx = document.getElementById('doughnutChart');

new Chart(doughnutCtx, {
    type: 'doughnut',
    data: {
        labels: statusLabel,
        datasets: [{
            data: statusData,
            backgroundColor: [
    '#fbbc05',
    '#4285f4',
    '#34a853',
    '#ea4335'
]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

const barCtx = document.getElementById('barChart');

new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: gradeLabel,
        datasets: [{
            data: gradeData,
            backgroundColor: [
                '#34a853',
                '#fbbc05',
                '#ea4335'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});