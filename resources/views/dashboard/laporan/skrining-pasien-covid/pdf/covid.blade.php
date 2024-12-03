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
        .emoticon-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            position: relative;
        }
        .emoticon {
            font-size: 28px;
            position: absolute;
            transform: translateX(20%);
            transform: translateY(-50%);
        }
        .slider-container {
            text-align: center;
        }
        .slider {
            width: 100%;
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        p, table, ol{
            font-size: 9pt;
        }
        .table > :not(caption) > * > *{
             padding: 5px;
        }
        .table-bondered th, td.uang{
            text-align: right !important;
            /* border: 1px solid #9896966e !important; */
        }
        .table-bondered th, td, th{
            border: 1px solid #dddada6e !important;
        }
        .bg-primary{
            background-color: #E0F6FB !important;
        }
        .bg-secondary{
            background-color: #83c5be !important;
            font-weight: bold !important;
        }
        table{
            font-size: 12px !important;
        }
        @page {
            margin: 0;
            size: portrait;
            padding: 0;
        }
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
                color-adjust: exact !important;                 /*Firefox*/     /*Firefox*/
            }
            /* html, body {
                width: 210mm;
                height: 297mm;
            } */
            .no-print, .no-print *
            {
                display: none !important;
            }
            .table > :not(caption) > * > *{
                padding: 5px;
            }
            .table-bondered th, td.uang{
                text-align: right !important;
                /* border: 1px solid #9896966e !important; */
            }
            .table-bondered th, td, th{
                border: 1px solid #dddada6e !important;
            }
            .bg-primary{
                background-color: #E0F6FB !important;
            }
            .bg-secondary{
                background-color: #83c5be !important;
                font-weight: bold !important;
            }
            table{
                font-size: 12px !important;
            }
        /* ... the rest of the rules ... */
        }
    </style>
</head>
<body>
    <div class="p-3">
        <div class="d-flex pt-4 ga-3">
            <div class="col-md-6 align-items-center">
                <div class="d-flex">
                    <div class="">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                    </div>
                    <div class="">
                        <h6 class="m-0 fw-bold text-center">RUMAH SAKIT DAERAH BALUNG  </h6>
                        <p class="m-0 text-center">Jl. Rambipuji No.19 Telp. 0336-621595, 623877
                            Balung – Jember 68161  </p>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="border  mx-auto py-2">
                        <h6 class="text-center m-0">FORMULIR SKRINING PASIEN</h6>

                    </div>

                </div>
            </div>
            <div class="col-md-6 w-50">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <tbody>
                            <tr>
                                <td width="20%">No. RM</td>
                                <td width="1%">:</td>
                                <td >{{ ucwords($pasien->no_rm) }}</td>
                            </tr>
                            <tr>
                                <td width="20%">Nama Pasien</td>
                                <td width="1%">:</td>
                                <td >{{ ucwords($pasien->nama_lengkap) }}</td>
                            </tr>
                            <tr>
                                <td width="20%">Tanggal Lahir</td>
                                <td width="1%">:</td>
                                <td >
                                   {{ $pasien->tanggal_lahir }}
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Alamat</td>
                                <td width="1%">:</td>
                                <td >{{ $pasien->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <!-- Tanggal dan Jam -->
        <div class="d-flex">
            <div class="w-50">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $pasien->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>No. RM</th>
                            <td>{{ $pasien->no_rm }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $pasien->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $pasien->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>{{ $pasien->pekerjaan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="w-50">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Komorbid</th>
                            <td>{{ $pasien->komorbid }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Pasien</th>
                            <td>{{ $pasien->jenis_pasien == 'baru' ? 'Baru' : 'Lama' }}</td>
                        </tr>
                        <tr>
                            <th>Penjamin Biaya</th>
                            <td>
                                @switch($pasien->penjamin_biaya)
                                    @case('umum') Umum @break
                                    @case('bpjs') BPJS @break
                                    @case('spm') SPM @break
                                    @case('jasa_raharja') Jasa Raharja @break
                                    @default Lainnya
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>Tujuan Pelayanan</th>
                            <td>
                                @switch($pasien->tujuan)
                                    @case('igd') IGD @break
                                    @case('airborne') Airborne @break
                                    @case('poli_klinik') Poli Klinik @break
                                    @default -
                                @endswitch
                            </td>
                        </tr>
                        @if ($pasien->tujuan == 'poli klinik')
                        <tr>
                            <th>Poli Klinik Tujuan</th>
                            <td>{{ $pasien->poli_tujuan }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Skrining Awal -->
        <h6 class="fw-bold">A. Skrining Awal (IGD dan Rawat Jalan)</h6>
        <div class="table-responsive">
            <table class="table table-bordered border">
            <thead >
                <tr>
                <th>No.</th>
                <th>Gejala</th>
                <th>YA</th>
                <th>TIDAK</th>
                </tr>
            </thead>
            <tbody class="border">
                <tr>
                <td>1</td>
                <td>Demam / Menggigil / Gejala 1 minggu terakhir</td>
                <td>
                    <div class="form-check">

                        <input type="radio" name="gejala_pasien1" value="1" class="form-check-input gejala" {{ $skrining_awal[0]->skor == 1 ? "checked" : "" }}/>
                    </div>
                </td>
                <td>
                    <input type="radio" name="gejala_pasien1" value="0" {{ $skrining_awal[0]->skor == 0 ? "checked" : "" }} class="form-check-input gejala" />
                </td>
                </tr>
                <tr>
                <td>2</td>
                <td>Batuk / Pilek / Sakit Tenggorokan</td>
                <td>
                    <input type="radio" name="gejala_pasien2" value="1" {{ $skrining_awal[1]->skor == 1 ? "checked" : "" }} class="form-check-input gejala" />
                </td>
                <td>
                    <input type="radio" name="gejala_pasien2" value="0" {{ $skrining_awal[1]->skor == 0 ? "checked" : "" }} class="form-check-input gejala" />
                </td>
                </tr>
                <tr>
                <td>3</td>
                <td>Sesak Napas</td>
                <td>
                    <input type="radio" name="gejala_pasien3" {{ $skrining_awal[2]->skor == 1 ? "checked" : "" }} value="1" class="form-check-input gejala" />
                </td>
                <td>
                    <input type="radio" name="gejala_pasien3" {{ $skrining_awal[2]->skor == 0 ? "checked" : "" }} value="0" class="form-check-input gejala" />
                </td>
                </tr>
                <tr>
                <td>4</td>
                <td>Riwayat Kontak erat dengan pasien Confirm Covid-19</td>
                <td>
                    <input type="radio" name="gejala_pasien4" {{ $skrining_awal[3]->skor == 1 ? "checked" : "" }} value="1" class="form-check-input gejala" />
                </td>
                <td>
                    <input type="radio" name="gejala_pasien4" {{ $skrining_awal[3]->skor == 0 ? "checked" : "" }} value="0" class="form-check-input gejala" />
                </td>
                </tr>
            </tbody>
            <tfoot class="border">
                <tr>
                <th colspan="3" class="text-end">Total Skor</th>
                <th><span id="totalSkriningAwal">{{ $pasien->total_skor_awal }}</span></th>
                </tr>
            </tfoot>
            </table>
        </div>
        <h6 class="fw-bold">Keterangan : <span id="keterangan">{{ $pasien->keterangan }}</span></h6>
        <hr>
        <!-- Skrining Lanjutan -->
        <h6 class="fw-bold">B. Skrining Lanjutan (IGD dan Rawat Inap)</h6>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Gejala</th>
                        <th>Ya</th>
                        <th>Tidak</th>
                        <th>Skor Bila "Ya"</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Riwayat kontak erat pasien Confirm Covid-19</td>
                        <td><input type="radio" {{ $skrining_lanjutan[0]->skor == 5 ? "checked" : "" }} name="gejala_lanjutan1" class="gejalaLanjutan" value="5"></td>
                        <td><input type="radio" {{ $skrining_lanjutan[0]->skor == 0 ? "checked" : "" }} name="gejala_lanjutan1" class="gejalaLanjutan" value="0"></td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Pria</td>
                        <td><input type="radio" {{ $skrining_lanjutan[1]->skor == 1 ? "checked" : "" }} name="gejala_lanjutan2" class="gejalaLanjutan" value="1"></td>
                        <td><input type="radio" {{ $skrining_lanjutan[1]->skor == 0 ? "checked" : "" }} name="gejala_lanjutan2" class="gejalaLanjutan" value="0"></td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Usia lebih dari 44 tahun</td>
                        <td><input type="radio" {{ $skrining_lanjutan[2]->skor == 1 ? "checked" : "" }} name="gejala_lanjutan3" class="gejalaLanjutan" value="1"></td>
                        <td><input type="radio" {{ $skrining_lanjutan[2]->skor == 0 ? "checked" : "" }} name="gejala_lanjutan3" class="gejalaLanjutan" value="0"></td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Sumer (37.8 °C)</td>
                        <td><input type="radio" {{ $skrining_lanjutan[3]->skor == 1 ? "checked" : "" }} name="gejala_lanjutan4" class="gejalaLanjutan" value="1"></td>
                        <td><input type="radio" {{ $skrining_lanjutan[3]->skor == 0 ? "checked" : "" }} name="gejala_lanjutan4" class="gejalaLanjutan" value="0"></td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Demam tinggi lebih dari 38.5 °C</td>
                        <td><input type="radio" {{ $skrining_lanjutan[4]->skor == 3 ? "checked" : "" }} name="gejala_lanjutan5" class="gejalaLanjutan" value="3"></td>
                        <td><input type="radio" {{ $skrining_lanjutan[4]->skor == 1 ? "checked" : "" }} name="gejala_lanjutan5" class="gejalaLanjutan" value="0"></td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Batuk / Pilek / Diare / Hilang rasa bau (Anosmia)</td>
                        <td><input type="radio" {{ $skrining_lanjutan[5]->skor == 1 ? "checked" : "" }} name="gejala_lanjutan6" class="gejalaLanjutan" value="1"></td>
                        <td><input type="radio" {{ $skrining_lanjutan[5]->skor == 0 ? "checked" : "" }} name="gejala_lanjutan6" class="gejalaLanjutan" value="0"></td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Sesak SpO2 kurang dari 95%</td>
                        <td><input type="radio" {{ $skrining_lanjutan[6]->skor == 5 ? "checked" : "" }} name="gejala_lanjutan7" class="gejalaLanjutan" value="5"></td>
                        <td><input type="radio" {{ $skrining_lanjutan[6]->skor == 0 ? "checked" : "" }} name="gejala_lanjutan7" class="gejalaLanjutan" value="0"></td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>NLR (% Neutrofil dibagi % Limfosit) ≥ 5.8</td>
                        <td><input type="radio" {{ $skrining_lanjutan[7]->skor == 1 ? "checked" : "" }} name="gejala_lanjutan8" class="gejalaLanjutan" value="1"></td>
                        <td><input type="radio" {{ $skrining_lanjutan[7]->skor == 0 ? "checked" : "" }} name="gejala_lanjutan8" class="gejalaLanjutan" value="0"></td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Pneumonia pada foto thorax</td>
                        <td><input type="radio" {{ $skrining_lanjutan[8]->skor == 1 ? "checked" : "" }} name="gejala_lanjutan9" class="gejalaLanjutan" value="5"></td>
                        <td><input type="radio" {{ $skrining_lanjutan[8]->skor == 0 ? "checked" : "" }} name="gejala_lanjutan9" class="gejalaLanjutan" value="0"></td>
                        <td>5</td>
                    </tr>
                </tbody>
                <tfoot class="border">
                    <tr>
                    <th colspan="3" class="text-end">Total Skor</th>
                    <th><span id="totalSkriningLanjutan">{{ $pasien->total_skor_lanjutan }}</span></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <h6 class="fw-bold">Keterangan: <span id="keteranganLanjutan">{{ $pasien->keterangan_lanjutan ?? '-' }}</span></h6>
        <div class="d-flex justify-content-end">
            <div>
                <p class="fw-bold">Dokter Penerima</p><br>
                <p>{{ $pasien->user->name }}</p>
            </div>
        </div>
    </div>


</body>
<script>
    // Fungsi untuk mencetak dan pindah halaman setelah selesai
    window.onload = function () {
        // Cetak halaman
        print();

        // Tunggu hingga proses cetak selesai, kemudian pindah rute
        window.onafterprint = function () {
            window.location.href = "{{ route('laporan.skrining-pasien') }}";
        };
    };
</script>
</html>
