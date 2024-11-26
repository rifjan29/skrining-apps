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
            <div class="col-md-6">
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
                <div class="mt-4">
                    <h4 class="text-center">SKRINING PASIEN DI IGD</h4>
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
        <div class="p-5">
            <!-- Tanggal dan Jam -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-4">
                <input type="date" class="form-control" name="tanggal" value="{{ $skrining_igd->tanggal ?? '-' }}" />
                </div>
                <label class="col-sm-2 col-form-label">Jam</label>
                <div class="col-sm-4">
                <input type="time" class="form-control" name="jam" value="{{ $skrining_igd->jam ?? '-' }}" />
                </div>
            </div>
            <hr>
            <!-- Penilaian Awal -->
            <h5>Penilaian Awal</h5>
            <div class="mb-3">
                <label class="form-label fw-bold">1. Primary Survey</label>
                <div class="mb-2">
                <label for="primary_survey_a" class="form-label">A (Airway)</label>
                <input type="text" class="form-control" name="primary_survey_a" value="{{ $skrining_igd->primary_survey_a }}" id="primary_survey_a" placeholder="Masukkan hasil penilaian" />
                </div>
                <div class="mb-2">
                <label for="primary_survey_b" class="form-label">B (Breathing)</label>
                <input type="text" class="form-control" name="primary_survey_b" id="primary_survey_b" value="{{ $skrining_igd->primary_survey_b }}" placeholder="Masukkan hasil penilaian" />
                </div>
                <div class="mb-2">
                <label for="primary_survey_c" class="form-label">C (Circulation)</label>
                <input type="text" class="form-control" name="primary_survey_c" id="primary_survey_c"  value="{{ $skrining_igd->primary_survey_c }}" placeholder="Masukkan hasil penilaian" />
                </div>
                <div class="mb-2">
                <label for="primary_survey_d" class="form-label">D (Disability)</label>
                <input type="text" class="form-control" name="primary_survey_d" id="primary_survey_d" value="{{ $skrining_igd->primary_survey_d }}" placeholder="Masukkan hasil penilaian" />
                </div>
                <div class="mb-2">
                <label for="primary_survey_e" class="form-label">E (Exposure)</label>
                <input type="text" class="form-control" name="primary_survey_e" id="primary_survey_e" value="{{ $skrining_igd->primary_survey_e }}" placeholder="Masukkan hasil penilaian" />
                </div>
            </div>
            <hr>
            <div class="mb-3">
                <label for="secondary_survey" class="form-label fw-bold">2. Secondary Survey</label>
                <textarea class="form-control" rows="3" name="secondary_survey" id="secondary_survey"> {{ $skrining_igd->secondary_survey }}</textarea>
            </div>
            <hr>
            <!-- Tanda-tanda Vital -->
            <div class="mb-3">
                <label class="form-label">Tanda-tanda Vital</label>
                <div class="row">
                    <div class="col">
                        <label for="td" class="form-label">TD (mmHg)</label>
                        <input type="text" class="form-control" value="{{ $skrining_igd->td }}" name="td" id="td" />
                    </div>
                    <div class="col">
                        <label for="nadi" class="form-label">Nadi (/menit)</label>
                        <input type="number" class="form-control" value="{{ $skrining_igd->nadi }}" name="nadi" id="nadi" />
                    </div>
                    <div class="col">
                        <label for="frekuensi_pernapasan" class="form-label">Frekuensi Pernapasan (/menit)</label>
                        <input type="number" class="form-control" value="{{ $skrining_igd->frekuensi_pernapasan }}" name="frekuensi_pernapasan" id="frekuensi_pernapasan" />
                    </div>
                    <div class="col">
                        <label for="suhu" class="form-label">Suhu (°C)</label>
                        <input type="number" step="0.1" value="{{ $skrining_igd->suhu }}" class="form-control" name="suhu" id="suhu" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="saturasi_oksigen" class="form-label">Saturasi Oksigen</label>
                <input type="number" class="form-control" value="{{ $skrining_igd->saturasi_oksigen }}" name="saturasi_oksigen" id="saturasi_oksigen" />
            </div>

            <div class="mb-3">
                <label for="riwayat_penyakit" class="form-label">Riwayat Penyakit / Pengobatan Sebelumnya</label>
                <textarea class="form-control" rows="3" name="riwayat_penyakit" id="riwayat_penyakit">{{ $skrining_igd->riwayat_penyakit }}</textarea>
            </div>
            <hr>
            <!-- Klasifikasi Pasien -->
            <div class="mb-3">
                <label class="form-label fw-bold">3. Klasifikasi Pasien</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="klasifikasi_pasien" {{ $skrining_igd->klasifikasi_pasien == 'IGD' ? "checked" : "" }} value="IGD" id="klasifikasi_igd" />
                    <label class="form-check-label" for="klasifikasi_igd">IGD</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="klasifikasi_pasien" value="Poliklinik" id="klasifikasi_poliklinik" {{ $skrining_igd->klasifikasi_pasien == 'Poliklinik' ? "checked" : "" }} />
                    <label class="form-check-label" for="klasifikasi_poliklinik">Poliklinik</label>
                </div>
            </div>
            <hr>
            <!-- Triage -->
            <div class="mb-3">
                <label class="form-label fw-bold">4. Triage (ATS : Australian Triage Scale)</label>
                <div class="form-check">
                <input class="form-check-input" type="radio" {{ $skrining_igd->triage == 'ATS 1' ? "checked" : "" }} name="triage" value="ATS 1" id="ats_1" />
                <label class="form-check-label" for="ats_1">ATS 1</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" {{ $skrining_igd->triage == 'ATS 2' ? "checked" : "" }} name="triage" value="ATS 2" id="ats_2" />
                <label class="form-check-label" for="ats_2">ATS 2</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" {{ $skrining_igd->triage == 'ATS 3' ? "checked" : "" }} name="triage" value="ATS 3" id="ats_3" />
                <label class="form-check-label" for="ats_3">ATS 3</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" {{ $skrining_igd->triage == 'ATS 4' ? "checked" : "" }} name="triage" value="ATS 4" id="ats_4" />
                <label class="form-check-label" for="ats_4">ATS 4</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" {{ $skrining_igd->triage == 'ATS 5' ? "checked" : "" }} name="triage" value="ATS 5" id="ats_5" />
                <label class="form-check-label" for="ats_5">ATS 5</label>
                </div>
            </div>
            <hr>
            <!-- Pemeriksaan Penunjang -->
            @php
                $penunjang = json_decode($skrining_igd->pemeriksaan_penunjang);
            @endphp

            <div class="mb-3">
                <label class="form-label fw-bold">5. Pemeriksaan Penunjang</label>
                <div class="form-check">
                <input class="form-check-input" {{ in_array('EKG',$penunjang) ? 'checked' : '' }} type="checkbox" name="pemeriksaan_penunjang[]" value="EKG" id="ekg" />
                <label class="form-check-label" for="ekg">EKG</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" {{ in_array('Laboratorium',$penunjang) ? 'checked' : '' }}  type="checkbox" name="pemeriksaan_penunjang[]" value="Laboratorium" id="laboratorium" />
                <label class="form-check-label" for="laboratorium">Laboratorium</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" {{ in_array('Radiologi',$penunjang) ? 'checked' : '' }} type="checkbox" name="pemeriksaan_penunjang[]" value="Radiologi" id="radiologi" />
                <label class="form-check-label" for="radiologi">Radiologi</label>
                </div>
            </div>
            <hr>
            <!-- Tindak Lanjut -->
            @php
                $tindak = json_decode($skrining_igd->tindak_lanjut);
            @endphp
            <div class="mb-3">
                <label class="form-label fw-bold">6. Tindak Lanjut</label>
                <div class="form-check">
                <input class="form-check-input" {{ in_array('Rawat',$tindak) ? 'checked' : '' }} type="checkbox" name="tindak_lanjut[]" value="Rawat" id="rawat" />
                <label class="form-check-label" for="rawat">Rawat</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" {{ in_array('Konsultasi',$tindak) ? 'checked' : '' }} name="tindak_lanjut[]" value="Konsultasi" id="konsultasi" />
                <label class="form-check-label" for="konsultasi">Konsultasi</label>
                </div>
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
