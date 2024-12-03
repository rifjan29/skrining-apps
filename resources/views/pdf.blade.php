<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontawesome  -->
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-family: 'Tinos', serif;
            font: 12pt;
        }

        .card-body {
            margin-bottom: 20px;
        }

        @page {
            margin: 0;
            size: landscape;
        }

        @media print {
            body {
                font-size: 12px !important;
            }

            .no-print {
                display: none !important;
            }

            /* Ensure the chart canvas is printed properly */
            .card-body {
                margin: 0;
                padding: 0;
            }

            .card {
                border: none !important;
            }

            /* Hide elements that should not appear in print */
            .no-print, .no-print * {
                display: none !important;
            }

            /* Make sure the chart is visible when printing */
            .card-body canvas {
                display: block !important;
                width: 100% !important;
                height: auto !important;
            }

            /* Optional: Hide header or style it for printing */
            /* .card-header {
                display: none !important;
            } */
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header">
                <h5 >Skrining Pasien</h5>
            </div>
            <div class="card-body">
                <canvas id="myChartdua" class="myChartdua" height="120px"></canvas>
            </div>
        </div>
        <button id="exportChart" class="btn btn-danger mt-3 no-print">Export PDF</button>
    </div>

    <!-- jQuery and Chart.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize the chart
            const ctx = $('#myChartdua')[0].getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            label: 'Skrining Pasien',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(44, 120, 220, 0.2)',
                            borderColor: 'rgba(44, 120, 220)',
                            data: @json($skrining_pasien_chart_data ?? [])
                        },
                        {
                            label: 'Skrining COVID',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(4, 209, 130, 0.2)',
                            borderColor: 'rgba(4, 209, 130)',
                            data: @json($skrinig_covid_chart_data ?? [])
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                usePointStyle: true,
                            },
                        },
                    }
                }
            });

            // Button for exporting PDF (or printing)
            $('#exportChart').click(function () {
                window.print(); // Trigger print dialog

                // Listen for after print and then redirect to dashboard
                window.onafterprint = function () {
                    window.location.href = '/dashboard'; // Ganti '/dashboard' dengan URL dashboard Anda
                };
            });
        });
    </script>
</body>
</html>
