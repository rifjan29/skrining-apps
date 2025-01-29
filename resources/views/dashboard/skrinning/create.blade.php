<x-app-layout>
    @push('css')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
         <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
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
            #signatureCanvas {
                border: 1px solid #000;
                width: 100%;
                height: 200px;
            }
        </style>

        <style>
            .select2.select2-container.select2-container--default{
                width: 900px !important;
            }
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
            .active-ket{
                display: none;
            }
            .select2-container--default .select2-selection--single {
                border-radius: 0.35rem !important;
                border: 1px solid #d1d3e2;
                height: calc(1.95rem + 5px);
                background: #fff;
            }

            .select2-container--default .select2-selection--single:hover,
            .select2-container--default .select2-selection--single:focus,
            .select2-container--default .select2-selection--single.active {
                box-shadow: none;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 32px;

            }

            .select2-container--default .select2-selection--multiple {
                border-color: #eaeaea;
                border-radius: 0;
            }

            .select2-dropdown {
                border-radius: 0;
            }

            .select2-container--default .select2-results__option--highlighted[aria-selected] {
                /* background-color: #3838eb; */
            }

            .select2-container--default.select2-container--focus .select2-selection--multiple {
                border-color: #eaeaea;
                background: #fff;

            }
        </style>
    @endpush
    @push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $('input[name="tgl"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: false,
                timePicker: false,
                startDate: moment().startOf('hour'),
                locale: {
                        format: 'Y-MM-DD'
                    }
            });

        });

    </script>
    <script>
        $(document).ready(function () {
            const $slider = $('#feelingRange');
            const $sliderValue = $('#sliderValue');

            // Perbarui nilai slider
            $slider.on('input', function () {
                const value = $(this).val();
                $sliderValue.text(`Nilai: ${value}`);
            });

            // Set nilai default awal
            $slider.trigger('input');
            // Inisialisasi Signature Pad
            const canvas = document.getElementById('signatureCanvas');
            const signaturePad = new SignaturePad(canvas);

            // Fungsi untuk menghapus tanda tangan
            const clearButton = document.getElementById('clearButton');
            clearButton.addEventListener('click', () => {
                signaturePad.clear();
            });

            // Resize canvas agar sesuai dengan perangkat
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext('2d').scale(ratio, ratio);
                signaturePad.clear(); // Hapus tanda tangan setelah resize
            }
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();
        });
    </script>
    <script>
        // Fungsi untuk toggle textarea
        function toggleTextarea(type) {
            const textarea = document.getElementById(`textarea-${type}`);
            const checkbox = document.getElementById(`checkbox-${type}`);

            if (checkbox.checked) {
                textarea.classList.remove('hidden');
            } else {
                textarea.classList.add('hidden');
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const isOldPatient = document.getElementById("is_old_patient");
            const newPatientField = document.getElementById("new_patient_field");
            const oldPatientField = document.getElementById("old_patient_field");
            const selectNoRm = document.getElementById("select_no_rm");
            const inputNama = document.getElementById("nama");
            const inputTgl = document.getElementById("tgl");
            const inputAlamat = document.getElementById("alamat");

            // Toggle antara input biasa dan select2
            isOldPatient.addEventListener("change", function () {
                if (this.checked) {
                    newPatientField.classList.add("d-none");
                    oldPatientField.classList.remove("d-none");
                } else {
                    newPatientField.classList.remove("d-none");
                    oldPatientField.classList.add("d-none");
                    inputNama.value = "";
                    inputTgl.value = "";
                    inputAlamat.value = "";
                }
            });

            // Inisialisasi Select2
            $(".select2").select2({
                ajax: {
                    url: `{{ route('api-pasien.index') }}`,
                    dataType: "json",
                    allowClear: false,
                    width:"100%",
                    // delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function (item) {
                                console.log(item);

                                return { id: item.no_rm, text: item.no_rm };
                            }),
                        };
                    },
                },
            });

            // Ketika pasien dipilih, ambil datanya
            $("#select_no_rm").on("change", function () {
                let selectedRm = $(this).val();
                if (!selectedRm) return;

                let url = `{{ url('search-pasien') }}/${selectedRm}`;

                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json", // Pastikan response JSON
                    success: function (response) {
                        console.log(response.nama_lengkap);
                        inputNama.value = response.nama_lengkap;
                        inputTgl.value = response.tanggal_lahir;
                        inputAlamat.value = response.alamat;
                    },
                    error: function (xhr, status, error) {
                        console.error("Error:", xhr.responseText);
                    },
                });
            });
        });
    </script>
    @endpush
    <section class="content-main mb-5">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(3))) }} Skrining Pasien</h2>
            <div>
                <button onclick="history.back()" class="btn btn-light"><i class="text-muted material-icons md-arrow_back"></i>Kembali</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card mb-4">
                    <header class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>Tambah Data Skrining Pasien</h4>
                        </div>

                    </header>
                    <div class="card-body">
                            <form action="{{ route('skrining-pasien.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>DATA DIRI PASIEN</h4>
                                    <hr>
                                    <label class="form-label fw-bold">
                                        <input type="checkbox" id="is_old_patient" />
                                        Checklist Pasien Lama
                                    </label> <br>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <!-- Input biasa untuk No RM -->
                                        <div class="col-md-12" id="new_patient_field">
                                            <div class="mb-4">
                                                <label for="no_rm" class="form-label fw-bold">No. RM</label>
                                                <input placeholder="Masukkan Data" type="text" value="{{ old('no_rm') }}" class="form-control @error('no_rm') is-invalid @enderror" name="no_rm" />
                                                @error('no_rm')
                                                    <div class="invalid-feedback">
                                                        {{$message}}.
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Select2 untuk pasien lama -->
                                        <div class="col-md-12 d-none" id="old_patient_field">
                                            <label for="select_no_rm" class="form-label fw-bold">Pilih No. RM</label>
                                            <div class="mb-4">
                                                <select id="select_no_rm" class="form-control form-select w-100 select2" name="no_rm_current">
                                                    <option value="">Cari No RM...</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label fw-bold">Nama Lengkap</label>
                                                <input placeholder="Masukkan Data" type="text" value="{{ old('nama') }}" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" />
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{$message}}.
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label fw-bold">Tanggal Lahir</label>
                                                <input placeholder="Tanggal" type="text"  value="{{ old('tgl') }}" id="tgl" class="form-control @error('tgl') is-invalid @enderror" name="tgl" />
                                                @error('tgl')
                                                    <div class="invalid-feedback">
                                                        {{$message}}.
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label fw-bold">Alamat</label>
                                                <textarea name="alamat" id="alamat" class="form-control" cols="30" placeholder="Masukkan Data" rows="10">{{ old('alamat') }}</textarea>
                                                @error('alamat')
                                                    <div class="invalid-feedback">
                                                        {{$message}}.
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>KELUHAN PASIEN</h4>
                                    <small>diisi oleh petugas skrining</small>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label fw-bold">Kondisi</label>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="gejala[]" value="pusing" id="pusing">
                                                        <label class="form-check-label" for="pusing">
                                                        Pusing
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="gejala[]" value="nyeri_dada" id="nyeri_dada">
                                                        <label class="form-check-label" for="nyeri_dada">
                                                        Nyeri Dada
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="gejala[]" value="mual" id="mual">
                                                        <label class="form-check-label" for="mual">
                                                        Mual
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="gejala[]" value="sesak" id="sesak">
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
                                                        <input
                                                          type="range"
                                                          name="feeling"
                                                          id="feelingRange"
                                                          class="form-range slider"
                                                          min="1"
                                                          max="10"
                                                          step="1"
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
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>KONDISI</h4>
                                    <small>Kondisi membahayakan diri/lingkungan</small>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label fw-bold">1. Peny. Menular/Sangat Infeksius/Airbone</label>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="peny_menular" value="ya" id="ya">
                                                        <label class="form-check-label" for="ya">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="peny_menular" value="tidak" id="tidak">
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
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="gang_kejiwaan[]" value="agresif" id="agresif">
                                                        <label class="form-check-label" for="agresif">
                                                        Agresif
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="gang_kejiwaan[]" value="depresif" id="depresif">
                                                        <label class="form-check-label" for="depresif">
                                                        Depresif
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="gang_kejiwaan[]" value="melukai diri" id="melukai diri">
                                                        <label class="form-check-label" for="melukai diri">
                                                        Melukai Diri
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="gang_kejiwaan[]" value="cenderung suicide" id="cenderung suicide">
                                                        <label class="form-check-label" for="cenderung suicide">
                                                        Cenderung Suicide
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="gang_kejiwaan[]" value="gang. kejiwaan" id="gang. kejiwaan">
                                                        <label class="form-check-label" for="gang. kejiwaan">
                                                        Gang. Kejiwaan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>SKRINING RESIKO JATUH </h4>
                                    <small>Bila ditemukan 1/2/3 maka dilanjutkan di kolom kebutuhan </small>
                                </div>
                                <div class="col-md-8">
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
                                                    <input type="radio" name="question1" value="ya" class="form-check-input">
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="question1" value="tidak" class="form-check-input">
                                                </td>
                                                <td class="d-flex flex-row">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="tindakan1-1" name="tindakan1[]" value="Perlu Brancart">
                                                        <label class="form-check-label" for="tindakan1-1">Perlu Brancart</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="tindakan1-2" name="tindakan1[]" value="Perlu Kursi Roda">
                                                        <label class="form-check-label" for="tindakan1-2">Perlu Kursi Roda</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Pertanyaan 2 -->
                                            <tr class="border">
                                                <td>Apakah pasien pernah jatuh dalam setahun terakhir?</td>
                                                <td class="text-center">
                                                    <input type="radio" name="question2" value="ya" class="form-check-input">
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="question2" value="tidak" class="form-check-input">
                                                </td>
                                                <td class="d-flex">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="tindakan2-1" name="tindakan2[]" value="Pasang Kalung Kuning">
                                                        <label class="form-check-label" for="tindakan2-1">Pasang Kalung Kuning</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="tindakan2-2" name="tindakan2[]" value="Edukasi Cegah Jatuh">
                                                        <label class="form-check-label" for="tindakan2-2">Edukasi Cegah Jatuh</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Pertanyaan 3 -->
                                            <tr class="border">
                                                <td>Apakah pasien merasa khawatir jatuh?</td>
                                                <td class="text-center">
                                                    <input type="radio" name="question3" value="ya" class="form-check-input">
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="question3" value="tidak" class="form-check-input">
                                                </td>
                                                <td class="d-flex">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="tindakan3-1" name="tindakan3[]" value="Antrian dipercepat">
                                                        <label class="form-check-label" for="tindakan3-1">Antrian dipercepat</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="tindakan3-2" name="tindakan3[]" value="Pelayanan didahulukan">
                                                        <label class="form-check-label" for="tindakan3-2">Pelayanan didahulukan</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>KEBUTUHAN </h4>
                                </div>
                                <div class="col-md-8">
                                    <!-- ANTRIAN -->
                                    <div class="mb-3">
                                        <h6>Antrian</h6>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="antrianDipercepat" name="antrian" value="dipercepat">
                                            <label class="form-check-label" for="antrianDipercepat">
                                                Antrian Dipercepat
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="pelayananDidahulukan" name="antrian" value="didahulukan">
                                            <label class="form-check-label" for="pelayananDidahulukan">
                                                Pelayanan Didahulukan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="diarahkanKeIGD" name="antrian" value="igd">
                                            <label class="form-check-label" for="diarahkanKeIGD">
                                                Diarahkan Ke IGD
                                            </label>
                                        </div>
                                    </div>

                                    <!-- SESUAI KEBUTUHAN -->
                                    <div class="mb-3">
                                        <h6>Sesuai Kebutuhan</h6>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="preventif" name="kebutuhan" value="preventif">
                                            <label class="form-check-label" for="preventif">
                                                Preventif
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="kuratif" name="kebutuhan" value="kuratif">
                                            <label class="form-check-label" for="kuratif">
                                                Kuratif
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rehabilitatif" name="kebutuhan" value="rehabilitatif">
                                            <label class="form-check-label" for="rehabilitatif">
                                                Rehabilitatif
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="paliatif" name="kebutuhan" value="paliatif">
                                            <label class="form-check-label" for="paliatif">
                                                Paliatif
                                            </label>
                                        </div>
                                    </div>

                                    <!-- BILA ADA -->
                                    <div class="mb-3">
                                        <h6>Bila Ada</h6>
                                        <p>Jalankan SPO - <i>"Identifikasi Pasien Membahayakan Diri Dan Lingkungan"</i></p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="antrianDipercepat2" name="bilaAda" value="dipercepat">
                                            <label class="form-check-label" for="antrianDipercepat2">
                                                Antrian Dipercepat
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="pelayananDidahulukan2" name="bilaAda" value="didahulukan">
                                            <label class="form-check-label" for="pelayananDidahulukan2">
                                                Pelayanan Didahulukan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="diarahkanKeIGD2" name="bilaAda" value="igd">
                                            <label class="form-check-label" for="diarahkanKeIGD2">
                                                Diarahkan Ke IGD
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="poliTB" name="bilaAda" value="poliTB">
                                            <label class="form-check-label" for="poliTB">
                                                Poli TB / Airborne IGD
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>USIA </h4>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <!-- USIA -->
                                            <tr class="border">
                                                <td class="border">
                                                    <ul class="list-unstyled mb-0">
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="usia" value="balita" id="balita">
                                                                <label class="form-check-label" for="balita">
                                                                    Balita &lt; 2 tahun kondisi rewel, lemah, apatis
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="usia" value="lansia" id="lansia">
                                                                <label class="form-check-label" for="lansia">
                                                                    Lansia, Usia &gt; 65 tahun
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="tindakan-usia" name="tindakan_usia" value="Antrian dipercepat">
                                                        <label class="form-check-label" for="tindakan-usia">Antrian dipercepat</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>GANGGUAN FUNGSI ORGAN </h4>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <!-- USIA -->
                                            <tr class="border">
                                                <td class="border">
                                                    <ul class="list-unstyled mb-0">
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gangguan" value="pendengaran" id="pendengaran">
                                                                <label class="form-check-label" for="pendengaran">
                                                                    1. Pendengaran
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gangguan" value="penglihatan" id="penglihatan">
                                                                <label class="form-check-label" for="penglihatan">
                                                                    2. Penglihatan
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gangguan" value="wicara" id="wicara">
                                                                <label class="form-check-label" for="wicara">
                                                                    3. Wicara
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="tindakan-usia" name="tindakan_gangguan" value="Butuh Pendampingan">
                                                        <label class="form-check-label" for="tindakan-usia">Butuh Pendampingan</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>PRIVASI TERTENTU </h4>
                                </div>
                                <div class="col-md-8">
                                        <table class="table table-bordered">
                                        <tbody>
                                            <!-- USIA -->
                                            <tr class="border">
                                                <td class="border">
                                                    <ul class="list-unstyled mb-0">
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="privasi_tertentu" value="pejabat" id="pejabat">
                                                                <label class="form-check-label" for="pejabat">
                                                                    1. Pejabat
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="privasi_tertentu" value="pemuka_agama" id="pemuka_agama">
                                                                <label class="form-check-label" for="pemuka_agama">
                                                                    2. Pemuka Agama
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="privasi_tertentu" value="pensiunan_rsd" id="pensiunan_rsd">
                                                                <label class="form-check-label" for="pensiunan_rsd">
                                                                    3. Pensiunan RSD Balung
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="tindakan-usia" name="tindakan_privasi" value="Pelayanan Didahulukan">
                                                        <label class="form-check-label" for="tindakan-usia">Pelayanan Didahulukan</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>BAHASA </h4>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <!-- USIA -->
                                            <tr class="border">
                                                <td class="border">
                                                    Bahasa kurang jelas, tidak bisa dipahami
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="tindakan-bahasa" name="tindakan_bahasa" value="Dibantu penerjemah (Verbal/Isyarat)">
                                                        <label class="form-check-label" for="tindakan-bahasa">Dibantu penerjemah (Verbal/Isyarat)</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                              <!-- Kriteria FAST TRACK -->
                            <div class="mb-4">
                                <h5>Kriteria FAST TRACK:</h5>
                                <p>
                                    Lansia / Disabilitas / Kesulitan Berjalan, Pasien TB Paru / Bayi 0-1 bulan / BBLR / anak rewel suhu &gt; 38.5°C
                                </p>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="fast-track" name="fast_track" value="FAST TRACK">
                                    <label class="form-check-label" for="fast-track">FAST TRACK</label>
                                </div>
                            </div>

                            <!-- Hasil Keputusan -->
                            <div class="row mb-4">
                                <div class="col-md-8">
                                    <div class="row text-center">
                                        <!-- Pasien DITERIMA -->
                                        <div class="col-md-4">
                                            <div class="form-check text-start">
                                                <input type="checkbox" class="form-check-input" id="checkbox-diterima" name="hasil_keputusan" onchange="toggleTextarea('diterima')" value="diterima">
                                                <label class="form-check-label fw-bold" for="checkbox-diterima">Pasien DITERIMA</label>
                                                <p>Tempat Pelayanan</p>
                                            </div>
                                            <textarea id="textarea-diterima" name="textarea_diterima" class="form-control hidden mt-2" placeholder="Masukkan tempat pelayanan"></textarea>
                                        </div>

                                        <!-- Pasien TIDAK DIANJURKAN -->
                                        <div class="col-md-4">
                                            <div class="form-check text-start">
                                                <input type="checkbox" class="form-check-input" id="checkbox-tidak-dianjurkan" name="hasil_keputusan" onchange="toggleTextarea('tidak-dianjurkan')" value="tidak dianjurkan">
                                                <label class="form-check-label fw-bold" for="checkbox-tidak-dianjurkan">Pasien TIDAK DIANJURKAN</label>
                                                <p>Alternatif yang dianjurkan</p>
                                            </div>
                                            <textarea id="textarea-tidak-dianjurkan" name="textarea_tidak_dianjurkan" class="form-control hidden mt-2" placeholder="Masukkan alternatif yang dianjurkan"></textarea>
                                        </div>

                                        <!-- Pasien DIRUJUK -->
                                        <div class="col-md-4">
                                            <div class="form-check text-start">
                                                <input type="checkbox" class="form-check-input" id="checkbox-dirujuk" name="hasil_keputusan" onchange="toggleTextarea('dirujuk')" value="dirujuk">
                                                <label class="form-check-label fw-bold" for="checkbox-dirujuk">Pasien DIRUJUK</label>
                                                <p>Tempat Rujukan</p>
                                            </div>
                                            <textarea id="textarea-dirujuk" name="textarea_dirujuk" class="form-control hidden mt-2" placeholder="Masukkan tempat rujukan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label fw-bold">Nama Terang Petugas</label>
                                        <div class="mb-3">
                                            <label for="signatureCanvas" class="form-label">Tanda Tangan</label>
                                            <div>
                                                <canvas id="signatureCanvas"></canvas>
                                            </div>
                                            <button type="button" class="btn btn-danger mt-2" id="clearButton">Hapus Tanda Tangan</button>
                                        </div>
                                        <input type="text" class="form-control" readonly value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-5">
            <button type="reset" class="btn btn-outline-danger">Batal</button>
            <button type="submit" class="btn btn-primary mx-2">Simpan</button>
        </form>

        </div>
        <!-- card end// -->
    </section>
</x-app-layout>
