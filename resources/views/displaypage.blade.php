<!DOCTYPE html>
<html>
<head>
    <title>Detection Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Detection Level Monitor</h1>
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
</html>