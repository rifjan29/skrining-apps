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
    <div class="">
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
        <div class="p-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>PENGAMATAN</th>
                        <th>KONDISI</th>
                        <th>KEBUTUHAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="2%">1</td>
                        <td width="10%"><h6 class="fw-bold">KELUHAN</h6> (di isi oleh petugas skrining)</td>
                        <td class="p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label fw-bold">Kondisi</label>
                                        @php
                                            $gejala = explode(',',$pasien->keluhan->gejala);
                                        @endphp
                                        <div class="row">
                                            <div class="form-check col-md-6">
                                                <input readonly readonly class="form-check-input" type="checkbox" {{ in_array('pusing',$gejala) ? 'checked' : '' }} name="gejala[]" value="pusing" id="pusing">
                                                <label class="form-check-label" for="pusing">
                                                Pusing
                                                </label>
                                            </div>
                                            <div class="form-check col-md-6">
                                                <input readonly class="form-check-input" type="checkbox" {{ in_array('nyeri_dada',$gejala) ? 'checked' : '' }} name="gejala[]" value="nyeri_dada" id="nyeri_dada">
                                                <label class="form-check-label" for="nyeri_dada">
                                                Nyeri Dada
                                                </label>
                                            </div>
                                            <div class="form-check col-md-6">
                                                <input readonly class="form-check-input" type="checkbox" {{ in_array('mual',$gejala) ? 'checked' : '' }} name="gejala[]" value="mual" id="mual">
                                                <label class="form-check-label" for="mual">
                                                Mual
                                                </label>
                                            </div>
                                            <div class="form-check col-md-6">
                                                <input readonly class="form-check-input" type="checkbox" {{ in_array('sesak',$gejala) ? 'checked' : '' }} name="gejala[]" value="sesak" id="sesak">
                                                <label class="form-check-label" for="sesak">
                                                Sesak
                                                </label>
                                            </div>
                                        </div>
                                        <div class="" style="margin-top: 20px">
                                            <div class="emoticon-container">
                                                <span class="emoticon" style="left: 0%;">😄</span>
                                                <span class="emoticon" style="left: 21%;">😊</span>
                                                <span class="emoticon" style="left: 43%;">😐</span>
                                                <span class="emoticon" style="left: 65%;">☹️</span>
                                                <span class="emoticon" style="left: 75%;">😢</span>
                                                <span class="emoticon" style="left: 98%;">😭</span>
                                            </div>
                                            <div class="slider-container">
                                                <input readonly
                                                    type="range"
                                                    name="feeling"
                                                    id="feelingRange"
                                                    class="form-range slider"
                                                    min="1"
                                                    max="10"
                                                    step="1"
                                                    value="{{ $pasien->keluhan->skala }}"
                                                >
                                                <div id="sliderValue" class="mt-2">Nilai: 5</div>
                                                </div>
                                        </div>
                                        @error('no_rm')
                                            <div class="invalid-feedback">
                                                {{$message}}.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <!-- ANTRIAN -->
                            <div class="mb-3">
                                <h6>Antrian</h6>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="radio" id="antrianDipercepat" {{ $pasien->kebutuhan->status_kebutuhan == 'dipercepat' ? 'checked' : '' }} name="antrian" value="dipercepat">
                                    <label class="form-check-label" for="antrianDipercepat">
                                        Antrian Dipercepat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="radio" id="pelayananDidahulukan" {{ $pasien->kebutuhan->status_kebutuhan == 'didahulukan' ? 'checked' : '' }} name="antrian" value="didahulukan">
                                    <label class="form-check-label" for="pelayananDidahulukan">
                                        Pelayanan Didahulukan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="radio" id="diarahkanKeIGD" {{ $pasien->kebutuhan->status_kebutuhan == 'igd' ? 'checked' : '' }} name="antrian" value="igd">
                                    <label class="form-check-label" for="diarahkanKeIGD">
                                        Diarahkan Ke IGD
                                    </label>
                                </div>
                            </div>

                            <!-- SESUAI KEBUTUHAN -->
                            @php
                                $kebutuhan = explode(',',$pasien->kebutuhan->jenis_kebutuhan);
                            @endphp
                            <div class="mb-3">
                                <h6>Sesuai Kebutuhan</h6>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="checkbox" {{ in_array('preventif',$kebutuhan) ? 'checked' : '' }} id="preventif" name="kebutuhan" value="preventif">
                                    <label class="form-check-label" for="preventif">
                                        Preventif
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="checkbox" {{ in_array('kuratif',$kebutuhan) ? 'checked' : '' }} id="kuratif" name="kebutuhan" value="kuratif">
                                    <label class="form-check-label" for="kuratif">
                                        Kuratif
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="checkbox" {{ in_array('rehabilitatif',$kebutuhan) ? 'checked' : '' }} id="rehabilitatif" name="kebutuhan" value="rehabilitatif">
                                    <label class="form-check-label" for="rehabilitatif">
                                        Rehabilitatif
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="checkbox" {{ in_array('paliatif',$kebutuhan) ? 'checked' : '' }} id="paliatif" name="kebutuhan" value="paliatif">
                                    <label class="form-check-label" for="paliatif">
                                        Paliatif
                                    </label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><h6 class="fw-bold">KONDISI MEMBAHAYAKAN DIRI/LINGKUNGAN</h6> (di isi oleh petugas skrining)</td>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label fw-bold">1. Peny. Menular/Sangat Infeksius/Airbone</label>
                                        <div class="d-flex">
                                            <div class="form-check mx-3">
                                                <input readonly class="form-check-input" type="radio" {{ $pasien->kondisi->jenis == 'ya' ? 'checked' : '' }} name="peny_menular" value="ya" id="ya">
                                                <label class="form-check-label" for="ya">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input readonly class="form-check-input" type="radio" name="peny_menular" {{ $pasien->kondisi->jenis == 'tidak' ? 'checked' : '' }} value="tidak" id="tidak">
                                                <label class="form-check-label" for="tidak">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label fw-bold">2. Gang Kejiwaan Perilaku Agresif/cenderung Bunuh Diri (Suicide)</label>
                                        @php
                                            $gangguan_jiwa = explode(',', $pasien->kondisi->perilaku);
                                        @endphp
                                        <div class="d-flex">
                                            <div class="mx-3">
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="checkbox" {{ in_array('agresif',$gangguan_jiwa) ? 'checked' : '' }} name="gang_kejiwaan[]" value="agresif" id="agresif">
                                                    <label class="form-check-label" for="agresif">
                                                    Agresif
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="checkbox" {{ in_array('depresif',$gangguan_jiwa) ? 'checked' : '' }} name="gang_kejiwaan[]" value="depresif" id="depresif">
                                                    <label class="form-check-label" for="depresif">
                                                    Depresif
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="checkbox" {{ in_array('melukai diri',$gangguan_jiwa) ? 'checked' : '' }} name="gang_kejiwaan[]" value="melukai diri" id="melukai diri">
                                                    <label class="form-check-label" for="melukai diri">
                                                    Melukai Diri
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="checkbox" {{ in_array('cenderung suicide',$gangguan_jiwa) ? 'checked' : '' }} name="gang_kejiwaan[]" value="cenderung suicide" id="cenderung suicide">
                                                    <label class="form-check-label" for="cenderung suicide">
                                                    Cenderung Suicide
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="checkbox"  {{ in_array('gang. kejiwaan',$gangguan_jiwa) ? 'checked' : '' }}  name="gang_kejiwaan[]" value="gang. kejiwaan" id="gang. kejiwaan">
                                                    <label class="form-check-label" for="gang. kejiwaan">
                                                    Gang. Kejiwaan
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="checkbox"  {{ in_array('Gang. Kognitif',$gangguan_jiwa) ? 'checked' : '' }}  name="gang_kognitif[]" value="Gang. Kognitif" id="Gang. Kognitif">
                                                    <label class="form-check-label" for="Gang. Kognitif">
                                                    Gang. Kognitif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <!-- BILA ADA -->
                            <div class="mb-3">
                                <h6>Bila Ada</h6>
                                <p>Jalankan SPO - <i>"Identifikasi Pasien Membahayakan Diri Dan Lingkungan"</i></p>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="radio" {{ $pasien->kondisi->status_kondisi == 'Antrian Dipercepat' ? 'checked' : '' }} id="antrianDipercepat2" name="bilaAda" value="dipercepat">
                                    <label class="form-check-label" for="antrianDipercepat2">
                                        Antrian Dipercepat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="radio" id="pelayananDidahulukan2" {{ $pasien->kondisi->status_kondisi == 'Pelayanan Didahulukan' ? 'checked' : '' }} name="bilaAda" value="didahulukan">
                                    <label class="form-check-label" for="pelayananDidahulukan2">
                                        Pelayanan Didahulukan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="radio" id="diarahkanKeIGD2" {{ $pasien->kondisi->status_kondisi == 'Diarahkan ke IGD' ? 'checked' : '' }} name="bilaAda" value="igd">
                                    <label class="form-check-label" for="diarahkanKeIGD2">
                                        Diarahkan Ke IGD
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input readonly class="form-check-input" type="radio" id="poliTB" {{ $pasien->kondisi->status_kondisi == 'Poli TB / Airborne IGD' ? 'checked' : '' }} name="bilaAda" value="poliTB">
                                    <label class="form-check-label" for="poliTB">
                                        Poli TB / Airborne IGD
                                    </label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><h6 class="fw-bold">SKRINING RISIKO JATUH </h6> (di isi oleh petugas skrining)</td>
                        <td colspan="2">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr class="border">
                                        <th>Pertanyaan</th>
                                        <th>Ya</th>
                                        <th>Tidak</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Pertanyaan 1 -->
                                    <tr class="border">
                                        <td>Apakah pasien merasa tidak stabil saat berdiri/berjalan?</td>
                                        <td class="text-center">
                                            <input readonly type="radio" name="question1" {{ $pasien->ResikoJatuh->pertanyaan_satu == 'ya' ? 'checked' : ''  }} value="ya" class="form-check-input">
                                        </td>
                                        <td class="text-center">
                                            <input readonly type="radio" name="question1" {{ $pasien->ResikoJatuh->pertanyaan_satu == 'tidak' ? 'checked' : ''  }} value="tidak" class="form-check-input">
                                        </td>
                                        <td class="d-flex flex-row">
                                            <div class="form-check">
                                                <input readonly type="checkbox" class="form-check-input" id="tindakan1-1" name="tindakan1[]" value="Perlu Brancart" {{ $pasien->ResikoJatuh->tindakan_satu == 'Perlu Brancart' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tindakan1-1" >Perlu Brancart</label>
                                            </div>
                                            <div class="form-check">
                                                <input readonly type="checkbox" class="form-check-input" id="tindakan1-2" name="tindakan1[]" value="Perlu Kursi Roda" {{ $pasien->ResikoJatuh->tindakan_dua == 'Perlu Kursi Roda' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tindakan1-2" >Perlu Kursi Roda</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Pertanyaan 2 -->
                                    <tr class="border">
                                        <td>Apakah pasien pernah jatuh dalam setahun terakhir?</td>
                                        <td class="text-center">
                                            <input readonly type="radio" name="question2" {{ $pasien->ResikoJatuh->pertanyaan_dua == 'ya' ? 'checked' : ''  }} value="ya" class="form-check-input">
                                        </td>
                                        <td class="text-center">
                                            <input readonly type="radio" name="question2" {{ $pasien->ResikoJatuh->pertanyaan_dua == 'tidak' ? 'checked' : ''  }} value="tidak" class="form-check-input">
                                        </td>
                                        <td class="d-flex">
                                            <div class="form-check">
                                                <input readonly type="checkbox" class="form-check-input" id="tindakan2-1" {{ $pasien->ResikoJatuh->tindakan_dua == 'Pasang Kalung Kuning' ? 'checked' : '' }} name="tindakan2[]" value="Pasang Kalung Kuning">
                                                <label class="form-check-label" for="tindakan2-1" >Pasang Kalung Kuning</label>
                                            </div>
                                            <div class="form-check">
                                                <input readonly type="checkbox" class="form-check-input" id="tindakan2-2" name="tindakan2[]" value="Edukasi Cegah Jatuh" {{ $pasien->ResikoJatuh->tindakan_dua == 'Edukasi Cegah Jatuh' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tindakan2-2">Edukasi Cegah Jatuh</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Pertanyaan 3 -->
                                    <tr class="border">
                                        <td>Apakah pasien merasa khawatir jatuh?</td>
                                        <td class="text-center">
                                            <input readonly type="radio" name="question3" {{ $pasien->ResikoJatuh->pertanyaan_tiga == 'ya' ? 'checked' : ''  }} value="ya" class="form-check-input">
                                        </td>
                                        <td class="text-center">
                                            <input readonly type="radio" name="question3" {{ $pasien->ResikoJatuh->pertanyaan_tiga == 'tidak' ? 'checked' : ''  }} value="tidak" class="form-check-input">
                                        </td>
                                        <td class="d-flex">
                                            <div class="form-check">
                                                <input readonly type="checkbox" class="form-check-input" id="tindakan3-1" {{ $pasien->ResikoJatuh->tindakan_tiga == 'Antrian dipercepat' ? 'checked' : '' }} name="tindakan3[]" value="Antrian dipercepat">
                                                <label class="form-check-label" for="tindakan3-1">Antrian dipercepat</label>
                                            </div>
                                            <div class="form-check">
                                                <input readonly type="checkbox" class="form-check-input" id="tindakan3-2" {{ $pasien->ResikoJatuh->tindakan_tiga == 'Pelayanan didahulukan' ? 'checked' : '' }} name="tindakan3[]" value="Pelayanan didahulukan">
                                                <label class="form-check-label" for="tindakan3-2">Pelayanan didahulukan</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><h6 class="fw-bold">USIA</h6></td>
                        <td colspan="2">
                            <table class="table table-bordered">
                                <tbody>
                                    <!-- USIA -->
                                    <tr class="border">
                                        <td class="border">
                                            <ul class="list-unstyled mb-0">
                                                <li>
                                                    <div class="form-check">
                                                        <input readonly class="form-check-input" type="radio" {{ $pasien->usia->jenis_usia == 'balita' ? 'checked' : '' }} name="usia" value="balita" id="balita">
                                                        <label class="form-check-label" for="balita">
                                                            Balita &lt; 2 tahun kondisi rewel, lemah, apatis
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input readonly class="form-check-input" type="radio" name="usia" {{ $pasien->usia->jenis_usia == 'lansia' ? 'checked' : '' }} value="lansia" id="lansia">
                                                        <label class="form-check-label" for="lansia">
                                                            Lansia, Usia &gt; 65 tahun
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input readonly type="checkbox" class="form-check-input" id="tindakan-usia" {{ $pasien->usia->status_usia == true ? "checked" : '' }} name="tindakan_usia" value="Antrian dipercepat">
                                                <label class="form-check-label" for="tindakan-usia">Antrian dipercepat</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><h6 class="fw-bold">GANGGUAN FUNGSI ORGAN</h6></td>
                        <td colspan="2">
                            <table class="table table-bordered">
                                <tbody>
                                    <!-- USIA -->
                                    <tr class="border">
                                        <td class="border">
                                            <ul class="list-unstyled mb-0">
                                                <li>
                                                    <div class="form-check">
                                                        <input readonly class="form-check-input" type="radio" {{ $pasien->GangguanFungsiOrgan->jenis_gangguan == 'pendengaran' ? 'checked' : "" }} name="gangguan" value="pendengaran" id="pendengaran">
                                                        <label class="form-check-label" for="pendengaran">
                                                            1. Pendengaran
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input readonly class="form-check-input" type="radio" {{ $pasien->GangguanFungsiOrgan->jenis_gangguan == 'penglihatan' ? 'checked' : "" }} name="gangguan" value="penglihatan" id="penglihatan">
                                                        <label class="form-check-label" for="penglihatan">
                                                            2. Penglihatan
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input readonly class="form-check-input" type="radio" {{ $pasien->GangguanFungsiOrgan->jenis_gangguan == 'wicara' ? 'checked' : "" }} name="gangguan" value="wicara" id="wicara">
                                                        <label class="form-check-label" for="wicara">
                                                            3. Wicara
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input readonly type="checkbox" class="form-check-input" id="tindakan-usia" {{ $pasien->GangguanFungsiOrgan->status_gangguan == true ? 'checked' : '' }} name="tindakan_gangguan" value="Butuh Pendampingan">
                                                <label class="form-check-label" for="tindakan-usia">Butuh Pendampingan</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><h6 class="fw-bold">PRIVASI TERTENTU</h6></td>
                        <td colspan="2">
                            <table class="table table-bordered">
                                <tbody>
                                    <!-- USIA -->
                                    <tr class="border">
                                        <td class="border">
                                            <ul class="list-unstyled mb-0">
                                                <li>
                                                    <div class="form-check">
                                                        <input readonly class="form-check-input" type="radio" {{ $pasien->PrivasiTertentu->jenis_privasi == 'pejabat' ? 'checked' : "" }} name="privasi_tertentu" value="pejabat" id="pejabat">
                                                        <label class="form-check-label" for="pejabat">
                                                            1. Pejabat
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input readonly class="form-check-input" type="radio" {{ $pasien->PrivasiTertentu->jenis_privasi == 'pemuka_agama' ? 'checked' : "" }} name="privasi_tertentu" value="pemuka_agama" id="pemuka_agama">
                                                        <label class="form-check-label" for="pemuka_agama">
                                                            2. Pemuka Agama
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input readonly class="form-check-input" type="radio" name="privasi_tertentu" {{ $pasien->PrivasiTertentu->jenis_privasi == 'pensiunan_rsd' ? 'checked' : "" }} value="pensiunan_rsd" id="pensiunan_rsd">
                                                        <label class="form-check-label" for="pensiunan_rsd">
                                                            3. Pensiunan RSD Balung
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input readonly type="checkbox" class="form-check-input" id="tindakan-usia"{{ $pasien->PrivasiTertentu->status_privasi == true ? 'checked' : '' }} name="tindakan_privasi" value="Pelayanan Didahulukan">
                                                <label class="form-check-label" for="tindakan-usia">Pelayanan Didahulukan</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td><h6 class="fw-bold">BAHASA</h6></td>
                        <td colspan="2">
                            <table class="table table-bordered">
                                <tbody>
                                    <!-- USIA -->
                                    <tr class="border">
                                        <td class="border">
                                            Bahasa kurang jelas, tidak bisa dipahami
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input readonly type="checkbox" class="form-check-input" {{ $pasien->bahasa->status_bahasa == true ? "checked" : '' }} id="tindakan-bahasa" name="tindakan_bahasa" value="Dibantu penerjemah (Verbal/Isyarat)">
                                                <label class="form-check-label" for="tindakan-bahasa">Dibantu penerjemah (Verbal/Isyarat)</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Kriteria FAST TRACK -->
            <div class="mb-4">
                <h5 class="fw-bold">Kriteria FAST TRACK:</h5>
                <p>
                    Lansia / Disabilitas / Kesulitan Berjalan, Pasien TB Paru / Bayi 0-1 bulan / BBLR / anak rewel suhu &gt; 38.5°C
                </p>
                <div class="form-check">
                    <input readonly type="checkbox" class="form-check-input" {{ $pasien->FastTrack->jenis_fast == true ? "checked" : "" }} id="fast-track" name="fast_track" value="FAST TRACK">
                    <label class="form-check-label" for="fast-track">FAST TRACK</label>
                </div>
            </div>

            <!-- Hasil Keputusan -->
            <div class="d-flex gap-2">
                <div class="col-md-8">
                    <div class="text-center d-flex gap-2">
                        <!-- Pasien DITERIMA -->
                        <div class="col-md-4">
                            <div class="form-check text-start">
                                <input readonly type="checkbox" class="form-check-input" id="checkbox-diterima" {{ $pasien->FastTrack->kategori_fast == 'diterima' ? 'checked' : '' }} name="hasil_keputusan" onchange="toggleTextarea('diterima')" value="diterima">
                                <label class="form-check-label fw-bold" for="checkbox-diterima">Pasien DITERIMA</label>
                                <p>Tempat Pelayanan</p>
                            </div>
                            <textarea id="textarea-diterima" name="textarea_diterima" class="form-control border-b {{ $pasien->FastTrack->kategori_fast == 'diterima' ? '' : 'hidden' }} mt-2" placeholder="Masukkan tempat pelayanan">{{ $pasien->FastTrack->kategori_fast == "diterima" ? $pasien->FastTrack->rujukan : '' }}</textarea>
                        </div>
                        <!-- Pasien TIDAK DIANJURKAN -->
                        <div class="col-md-4">
                            <div class="form-check text-start">
                                <input readonly type="checkbox" class="form-check-input" id="checkbox-tidak-dianjurkan" {{ $pasien->FastTrack->kategori_fast == 'tidak dianjurkan' ? 'checked' : '' }} name="hasil_keputusan" onchange="toggleTextarea('tidak-dianjurkan')" value="tidak dianjurkan">
                                <div class="d-flex">
                                    <label class="form-check-label fw-bold" for="checkbox-tidak-dianjurkan">Pasien</label>
                                    <p class="m-0 align-self-center" style="font-size: 10px"> TIDAK DIANJURKAN</p>
                                </div>
                                <p>Alternatif yang dianjurkan</p>
                            </div>
                            <textarea id="textarea-tidak-dianjurkan" name="textarea_tidak_dianjurkan" class="form-control {{ $pasien->FastTrack->kategori_fast == 'tidak dianjurkan' ? '' : 'hidden' }} mt-2" placeholder="Masukkan alternatif yang dianjurkan">{{ $pasien->FastTrack->kategori_fast == "tidak dianjurkan" ? $pasien->FastTrack->rujukan : '' }}</textarea>
                        </div>
                        <!-- Pasien DIRUJUK -->
                        <div class="col-md-4">
                            <div class="form-check text-start">
                                <input readonly type="checkbox" class="form-check-input" id="checkbox-dirujuk" {{ $pasien->FastTrack->kategori_fast == 'dirujuk' ? 'checked' : '' }} name="hasil_keputusan" onchange="toggleTextarea('dirujuk')" value="dirujuk">
                                <label class="form-check-label fw-bold" for="checkbox-dirujuk">Pasien DIRUJUK</label>
                                <p>Tempat Rujukan</p>
                            </div>
                            <textarea id="textarea-dirujuk" name="textarea_dirujuk" class="form-control {{ $pasien->FastTrack->kategori_fast == 'dirujuk' ? '' : 'hidden' }} mt-2" placeholder="Masukkan tempat rujukan">{{ $pasien->FastTrack->rujukan }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mx-3">
                    <div class="form-group">
                        <label for="" class="form-label fw-bold">Nama Terang Petugas</label>
                        <input readonly type="text" class="form-control mt-5" readonly value="{{ Auth::user()->name }}">
                    </div>
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
