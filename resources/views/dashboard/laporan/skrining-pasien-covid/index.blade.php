<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
        <style>
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
        </style>
    @endpush
    @push('js')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    language: {
                        emptyTable: "Data tidak ada"
                    }
                });
                $('.datepicker').daterangepicker({
                    singleDatePicker: true, // Enable single date selection
                    format: 'yyyy-mm-dd', // Match Laravel's date format
                    autoclose: true,
                    todayHighlight: true,
                });

            })
        </script>
    @endpush
    @include('dashboard.user.modal')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(2))) }}</h2>
        </div>
        @include('components.notification')
        <div id="alerts-container"></div>
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('laporan.skrining-covid') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date">Start Date:</label>
                            <input type="text" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control datepicker" required>
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">End Date:</label>
                            <input type="text" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control datepicker" required>
                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <h4>List Skrining Pasien</h4>
            </header>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered border table-hover" id="example">
                        <thead>
                            <tr class="border">
                                <th>No</th>
                                <th scope="col">Kode Skrining</th>
                                <th scope="col">No. RM</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">Jenis Pasien</th>
                                <th scope="col">Penjamin Biaya</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Keterangan Awal Pasien</th>
                                <th scope="col">Keterangan Lanjutan Pasien</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col" class="text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td class="border">{{ $loop->iteration }}</td>
                                    <td class="border">{{ $item->kode_transaksi }}</td>
                                    <td class="border">{{ $item->no_rm }}</td>
                                    <td class="border">{{ $item->nama_lengkap }}</td>
                                    <td class="border">{{ $item->jenis_pasien }}</td>
                                    <td class="border">{{ $item->penjamin_biaya }}</td>
                                    <td class="border">{{ $item->tujuan }}</td>
                                    <td class="border">
                                        {!! checkItemStatus($item) !!}
                                    </td>
                                    <td class="border">
                                        @if ($item->keterangan_lanjutan == null)
                                            <span class="badge rounded-pill alert-success">SELESAI</span><br>
                                            <hr>
                                            <small class="fw-bold text-sm">Skor : {{ $item->total_skor_lanjutan }}</small>
                                        @else
                                            <span class="badge rounded-pill alert-warning">{{ $item->keterangan_lanjutan }}</span> <br>
                                            <hr>
                                            <small class="fw-bold text-sm">Skor : {{ $item->total_skor_lanjutan }}</small>
                                        @endif
                                    </td>
                                    <td class="border">{{ $item->created_at }}</td>
                                    <td class="text-start border">
                                        <div class="d-flex justify-content-start">
                                            <div>
                                                <a href="{{ route('laporan.skrining-covid.show',$item->id) }}" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-panorama_fish_eye"></i> Detail </a>
                                            </div>
                                        </div>
                                        <!-- dropdown //end -->
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
