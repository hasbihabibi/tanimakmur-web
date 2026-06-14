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
                '#2f8f3d',
                '#fbbc05',
                '#ea4335',
                '#4285f4'
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
            label: 'Volume Panen (Kg)',
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
        maintainAspectRatio: false
    }
});