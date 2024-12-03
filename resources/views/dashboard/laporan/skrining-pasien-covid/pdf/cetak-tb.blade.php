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
    <div class="containe-fluid">
        <div class="d-flex">
            <div class="col-md-6 align-self-center">
                <div class="d-flex justify-content-center align-items-center content-items-center">
                    <div>
                        <img src="{{ asset('images/logo.png') }}" alt="">
                    </div>
                    <div>
                        <h5 class="m-0">RUMAH SAKIT DAERAH BALUNG  </h5>
                        <p class="m-0">Jl. Rambipuji No.19 Telp. 0336-621595, 623877
                            Balung – Jember 68161  </p>
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
                                <td width="20%">Tempat & Tanggal Lahir</td>
                                <td width="1%">:</td>
                                <td >
                                   {{ $pasien->tempat_lahir }} / {{ $pasien->tanggal_lahir }}
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
        <div class="mt-4">
            <h5 class="text-center">SKRINING TB</h5>

        </div>
        <hr>
        <div class="p-5">
            <!-- Tanggal dan Jam -->
            <div class="d-flex">
                <div class="w-50">
                <label for="tanggalKedatangan" class="form-label">Tanggal Kedatangan</label>
                <input type="date" class="form-control" value="{{ $skrining_tb->tanggal_kedatangan }}" id="tanggalKedatangan" name="tanggal_kedatangan">
                </div>
                <div class="w-50">
                <label for="jamDatang" class="form-label">Jam Datang</label>
                <input type="time" class="form-control" value="{{ $skrining_tb->jam_datang }}" id="jamDatang" name="jam_datang">
                </div>
            </div>
            <div class="d-flex">
                <div class="w-50">
                <label for="tanggalPeriksa" class="form-label">Tanggal Periksa</label>
                <input type="date" class="form-control" value="{{ $skrining_tb->tanggal_periksa }}" id="tanggalPeriksa" name="tanggal_periksa">
                </div>
                <div class="w-50">
                <label for="jamPeriksa" class="form-label">Jam Periksa</label>
                <input type="time" class="form-control" value="{{ $skrining_tb->jam_periksa }}" id="jamPeriksa" name="jam_periksa">
                </div>
            </div>

            <!-- Tanda dan Gejala -->

            <table class="table table-bordered">
                <thead>
                <tr class="border">
                    <th>No</th>
                    <th>Tanda dan Gejala TB</th>
                    <th>Ya</th>
                    <th>Tidak</th>
                </tr>
                </thead>
                <tbody>
                <tr class="border">
                    <td>1</td>
                    <td>Batuk Berdahak selama &gt; 2-3 Minggu</td>
                    <td><input type="radio" name="gejala1" {{ $skrining_tb->pertanyaan_satu == "ya" ? "checked" : "" }} value="ya"></td>
                    <td><input type="radio" name="gejala1" {{ $skrining_tb->pertanyaan_satu == "tidak" ? "checked" : "" }} value="tidak"></td>
                </tr>
                <tr class="border">
                    <td>2</td>
                    <td>Batuk Berdarah</td>
                    <td><input type="radio" name="gejala2" {{ $skrining_tb->pertanyaan_dua == "ya" ? "checked" : "" }} value="ya"></td>
                    <td><input type="radio" name="gejala2" {{ $skrining_tb->pertanyaan_dua == "tidak" ? "checked" : "" }} value="tidak"></td>
                </tr>
                <tr class="border">
                    <td>3</td>
                    <td>Demam Hilang Timbul &gt; 1 bulan</td>
                    <td><input type="radio" name="gejala3" {{ $skrining_tb->pertanyaan_tiga == "ya" ? "checked" : "" }} value="ya"></td>
                    <td><input type="radio" name="gejala3" {{ $skrining_tb->pertanyaan_tiga == "tidak" ? "checked" : "" }} value="tidak"></td>
                </tr>
                <tr class="border">
                    <td>4</td>
                    <td>Keringat malam tanpa aktivitas</td>
                    <td><input type="radio" name="gejala4" {{ $skrining_tb->pertanyaan_empat == "ya" ? "checked" : "" }} value="ya"></td>
                    <td><input type="radio" name="gejala4" {{ $skrining_tb->pertanyaan_empat == "tidak" ? "checked" : "" }} value="tidak"></td>
                </tr>
                <tr class="border">
                    <td>5</td>
                    <td>Penurunan berat badan tanpa penyebab yang jelas</td>
                    <td><input type="radio" name="gejala5" {{ $skrining_tb->pertanyaan_lima == "ya" ? "checked" : "" }} value="ya"></td>
                    <td><input type="radio" name="gejala5" {{ $skrining_tb->pertanyaan_lima == "tidak" ? "checked" : "" }} value="tidak"></td>
                </tr>
                <tr class="border">
                    <td>6</td>
                    <td>Pembesaran kelenjar getah bening</td>
                    <td><input type="radio" name="gejala6" {{ $skrining_tb->pertanyaan_enam == "ya" ? "checked" : "" }} value="ya"></td>
                    <td><input type="radio" name="gejala6" {{ $skrining_tb->pertanyaan_enam == "tidak" ? "checked" : "" }} value="tidak"></td>
                </tr>
                <tr class="border">
                    <td>7</td>
                    <td>Sesak napas dan nyeri dada</td>
                    <td><input type="radio" name="gejala7" {{ $skrining_tb->pertanyaan_tujuh == "ya" ? "checked" : "" }} value="ya"></td>
                    <td><input type="radio" name="gejala7" {{ $skrining_tb->pertanyaan_tujuh == "tidak" ? "checked" : "" }} value="tidak"></td>
                </tr>
                <tr class="border">
                    <td>8</td>
                    <td>Pernah minum obat paru dalam waktu lama sebelumnya</td>
                    <td><input type="radio" name="gejala8" {{ $skrining_tb->pertanyaan_delapan == "ya" ? "checked" : "" }} value="ya"></td>
                    <td><input type="radio" name="gejala8" {{ $skrining_tb->pertanyaan_delapan == "tidak" ? "checked" : "" }} value="tidak"></td>
                </tr>
                <tr class="border">
                    <td>9</td>
                    <td>Ada keluarga/tetangga yang pernah sakit paru/TB/Pengobatan paru dalam jangka waktu yang lama</td>
                    <td><input type="radio" name="gejala9" {{ $skrining_tb->pertanyaan_sembilan == "ya" ? "checked" : "" }} value="ya"></td>
                    <td><input type="radio" name="gejala9" {{ $skrining_tb->pertanyaan_sembilan == "tidak" ? "checked" : "" }} value="tidak"></td>
                </tr>
                <tr class="border">
                    <td>10</td>
                    <td>Penyakit Lain: <br> &bull; Asma <br> &bull; DM <br> &bull; HIV</td>
                    <td><input type="radio" name="gejala10" {{ $skrining_tb->pertanyaan_sepuluh == "ya" ? "checked" : "" }} value="ya"></td>
                    <td><input type="radio" name="gejala10" {{ $skrining_tb->pertanyaan_sepuluh == "tidak" ? "checked" : "" }} value="tidak"></td>
                </tr>
                </tbody>
            </table>
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
