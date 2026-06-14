const lineCtx = document.getElementById('lineChart');

new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: ['Nov', 'Des', 'Jan', 'Feb', 'Mar', 'Apr'],
        datasets: [
            {
                label: 'Panen',
                data: [420, 510, 470, 620, 710, 650],
                borderColor: '#2f8f3d',
                tension: 0.4,
                fill: false
            },
            {
                label: 'Distribusi',
                data: [320, 450, 430, 580, 640, 590],
                borderColor: '#fbbc05',
                tension: 0.4,
                fill: false
            }
        ]
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
        labels: ['Diterima', 'Terkirim', 'Pending'],
        datasets: [{
            data: [65, 25, 10],
            backgroundColor: ['#2f8f3d', '#fbbc05', '#ea4335']
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