<!DOCTYPE html>
<html>
<head>
    <title>Birds Detection</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>

</head>
<body>
    <div class="container-fluid">
        <div class="header">
            <h2>Bird Detection Monitor</h2>
        </div>

        <canvas id="textsChart" width="400" height="200"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('textsChart').getContext('2d');
            var initialData = @json($texts); 

            // Function to initialize or update the chart
            function initializeChart(data) {
                var labels = data.map(function (item) {
                    return item.date;
                });
                var values = data.map(function (item) {
                    return item.count;
                });

                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Level of Detection',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Level of Detection'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
                return chart;
            }

            // Initial chart creation
            var chart = initializeChart(initialData);

            // Function to update chart data
            function updateChartData() {
                fetch('/datareceive') 
                    .then(response => response.json())
                    .then(data => {
                        chart.destroy(); 
                        chart = initializeChart(data); 
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }

            setInterval(updateChartData, 2000); 
        });
    </script>
</body>
</html>




{{-- <!DOCTYPE html>
<html>
<head>
    <title>Detection Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Birds Detection Monitor</h1>
        <div class="row">
            <div class="col-md-12">
                <h3>Sensor Data</h3>
                <canvas id="detectionChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('detectionChart').getContext('2d');
        const detectionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [
                    {
                        label: 'Sensor 1 Detection Level',
                        data: [],
                        borderColor: 'rgba(241, 106, 38, 255)',
                        borderWidth: 5,
                        fill: false
                    },
                    {
                        label: 'Sensor 2 Detection Level',
                        data: [],
                        borderColor: 'rgba(255, 65, 116, 250)',
                        borderWidth: 5,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'minute',
                            tooltipFormat: 'll HH:mm'
                        },
                        title: {
                            display: true,
                            text: 'Time'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Detection Level'
                        }
                    }
                }
            }
        });

        function fetchData() {
            fetch('/api/fetch/detection-data')
                .then(response => response.json())
                .then(data => {
                    let sensor1Data = data.filter(d => d.sensor_id === 'sensor1');
                    let sensor2Data = data.filter(d => d.sensor_id === 'sensor2');

                    detectionChart.data.labels = sensor1Data.map(d => new Date(d.created_at));
                    detectionChart.data.datasets[0].data = sensor1Data.map(d => ({ x: new Date(d.created_at), y: d.detection_level }));
                    detectionChart.data.datasets[1].data = sensor2Data.map(d => ({ x: new Date(d.created_at), y: d.detection_level }));
                    detectionChart.update();
                });
        }

        setInterval(fetchData, 1000); 
    </script>
</body>
</html> --}}