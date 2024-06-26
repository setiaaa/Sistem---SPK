<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">SPK Diselesaikan</h6>
    </div>
    <div class="card-body">
        <div class="chart-area">
            <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                    <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                    <div class=""></div>
                </div>
            </div>
            <canvas id="myBarChart"></canvas>
        </div>
    </div>
</div>
<script type="text/javascript">
    fetch('{{ route('dashboard') }}')
        .then(response => response.json())
            var ctx = document.getElementById("myBarChart");
            var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($barlabels),
                datasets: [{
                label: "SPK",
                backgroundColor: "#5889F4",
                hoverBackgroundColor: "#2C4DAF",
                borderColor: "#4e73df",
                data: @json($barcount),
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        position: 'bottom',
                    }
                },
                maintainAspectRatio: false,
                layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
                },
                scales: {
                xAxes: [{
                    time: {
                    unit: 'month'
                    },
                    gridLines: {
                    display: false,
                    drawBorder: false
                    },
                    ticks: {
                    maxTicksLimit: 6
                    },
                    maxBarThickness: 25,
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: 1500,
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return '$' + number_format(value);
                    }
                    },
                    gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                    }
                }],
                },
                legend: {
                display: false
                },
                tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    }
                }
                },
            }
            });
</script>