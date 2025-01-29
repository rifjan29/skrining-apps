<x-app-layout>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            $(document).ready(function () {
                // Sale statistics Chart
                // Initialize chart
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
                                    data: @json(array_values($skrining_pasien_chart_data ?? []))
                                },
                                {
                                    label: 'Skrining COVID',
                                    tension: 0.3,
                                    fill: true,
                                    backgroundColor: 'rgba(4, 209, 130, 0.2)',
                                    borderColor: 'rgba(4, 209, 130)',
                                    data: @json(array_values($skrinig_covid_chart_data ?? []))
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
                            },
                        }
                    });

                    // Filter functionality
                    $('#filterButton').click(function () {
                        const year = $('#year').val();
                        const date = $('#date').val();
                        $('#yearInput').val(year); // Get year from input
                        $('#dateInput').val(date); // Get date from input
                        $.ajax({
                            url: '/dashboard',
                            type: 'GET',
                            data: { year: year, date: date },
                            success: function (data) {
                                // Update chart data
                                chart.data.datasets[0].data = data.skrining_pasien_data;
                                chart.data.datasets[1].data = data.skrinig_covid_data;
                                chart.update();

                                // Update totals
                                $('#totalSkriningPasien').text(data.skrining_pasien);
                                $('#totalCovidSkrining').text(data.skrinig_covid);
                            },
                            error: function () {
                                alert('Error fetching data');
                            }
                        });
                    });

                    // Export chart to PDF
                    $('#exportChart').click(function (e) {
                        e.preventDefault(); // Prevent default anchor behavior

                        const year = $('#yearInput').val(); // Get year from input
                        const date = $('#dateInput').val(); // Get date from input

                        if (!year || !date) {
                            alert('Please fill in both year and date before exporting.');
                            return;
                        }

                        // Ganti URL dengan menambahkan parameter year dan date
                        const exportUrl = `/export-chart?year=${year}&date=${date}`;

                        // Set href dengan URL baru
                        $(this).attr('href', exportUrl);

                        // Optionally, trigger a click event to go to the new URL
                        window.location.href = exportUrl;
                    });

                // Revenue statistics Chart
                @php
                    $labels = $jumlah_pasien_kelamin->pluck('jenis_kelamin');
                    $data = $jumlah_pasien_kelamin->pluck('jumlah');
                @endphp
                if (document.getElementById('myChart2')) {
                    var ctx2 = document.getElementById('myChart2').getContext('2d');
                    var myChart2 = new Chart(ctx2, {
                        type: 'bar',
                        data: {
                            labels: ["Perempuan","Laki-Laki"], // Labels untuk jenis kelamin
                            datasets: [
                                {
                                    label: "Jumlah Pasien",
                                    backgroundColor: ['#5897fb', '#7bcf86', '#ff9076', '#d595e5'], // Warna bar
                                    barThickness: 10,
                                    data: @json($data) // Data jumlah pasien
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
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            })


        </script>
    @endpush
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Dashboard</h2>
                <p>Whole data about your business here</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Skrining Pasien</h6>
                            <span>{{ $skrining_pasien }}</span>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Skrining Pasien IGD</h6>
                            <span>{{ $skrining_igd }}</span>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Skrining Pasien TB</h6>
                            <span>{{ $skrining_tb }}</span>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Skrining Pasien Covid</h6>
                            <span>{{ $skrinig_covid }}</span>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Skrining Pasien</h5>
                            <!-- Filter Form -->
                            <div class="card card-body">
                                <form id="filterForm" class="row">
                                    <div class="col-md-6">
                                        <label for="year">Tahun:</label>
                                        <select class="form-select" id="year" name="year">
                                            <option value="">Semua Tahun</option>
                                            @for ($i = date('Y'); $i >= 2000; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date">Tanggal:</label>
                                        <input class="form-control" type="date" id="date" name="date">
                                    </div>
                                    <button type="button" class="btn btn-primary mt-3" id="filterButton">Filter</button>
                                    <!-- Export Button -->
                                    <input type="text" id="yearInput" hidden placeholder="Enter year" />
                                    <input type="date" id="dateInput" hidden placeholder="Select date" />

                                    <a href="{{ route('dashboard.pdf') }}" id="exportChart" class="btn btn-danger mt-3">Export PDF</a>
                                </form>
                            </div>
                        <canvas id="myChartdua" class="myChartdua" height="120px"></canvas>
                    </article>
                </div>

            </div>
            <div class="col-xl-4 col-lg-12">
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Jumlah Pasien</h5>
                        <canvas id="myChart2" height="217"></canvas>
                    </article>
                </div>
            </div>
        </div>

    </section>
</x-app-layout>
