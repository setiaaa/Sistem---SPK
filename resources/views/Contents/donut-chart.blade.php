<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">SPK Bulan Ini</h6>
    </div>
    <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
            <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                    <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                    <div class=""></div>
                </div>
            </div>
            <canvas id="myDonutChart"></canvas>
        </div>
    </div>
</div>
<script type="text/javascript">
    fetch('{{ route('dashboard') }}')
    .then(response => response.json())
        var ctx = document.getElementById("myDonutChart");
        var myDonutChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($donutstatus),
                datasets: [{
                    data: @json($donutcount),
                    backgroundColor: @json($donutcolors),
                    hoverBackgroundColor: @json($donuthovers),
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: true,
                caretPadding: 5,
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                cutoutPercentage: 100,
            },
        });
</script>