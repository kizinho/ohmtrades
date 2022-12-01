const ctx1 = document.getElementById('myChart');

new Chart(ctx1, {
    type: 'bar',

    data: {
        labels: ['Apr 20', 'Apr 20', 'Apr 20', 'Apr 20', 'Apr 20', 'Apr 20'],
        datasets: [{
            label: '',

            data: [600, 800, 700, 650, 800, 700],
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: true,
        scales: {
            y: {
                beginAtZero: false
            }
        }
    }
});



function getResponsive() {
    if (window.innerWidth <= 500) {
        return false;
    }
    return true
}
const ctx = document.getElementById('myLineChart');
const labels = ["1", "1", "1", "1", "1", "1", "1", "1",];
const data = {
    labels: labels,
    datasets: [
        {
            label: 'Dataset 1',
            data: [1, 2, 3, 4, 5, 6, 6],
            // borderColor: Utils.CHART_COLORS.red,
            // backgroundColor: Utils.transparentize(Utils.CHART_COLORS.red, 0.5),
            yAxisID: 'y',
        },
        {
            label: 'Dataset 2',
            data: [5, 2, 3, 4, 5, 6, 6],
            // borderColor: Utils.CHART_COLORS.blue,
            // backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),
            yAxisID: 'y1',
        }
    ]
};
const stackedLine = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        // maintainAspectRatio: false,
        interaction: {
            mode: 'index',
            intersect: false,
        },
        stacked: false,
        plugins: {
            title: {
                display: true,
                text: ''
            }
        },
        scales: {
            y: {
                type: 'linear',
                display: true,
                position: 'left',
            },
            y1: {
                type: 'linear',
                display: false,
                position: 'right',

                // grid line settings
                grid: {
                    drawOnChartArea: false, // only want the grid lines for one axis to show up
                },
            },
        }
    },
});
