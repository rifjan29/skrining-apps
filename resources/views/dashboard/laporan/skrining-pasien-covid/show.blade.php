<x-app-layout>
    @push('css')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
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
    @endpush
    @push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad/dist/signature_pad.umd.min.js"></script>
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
                <div class="card mb-4">
                    <header class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>Detail Data Skrining Pasien Covid</h4>
                        </div>

                    </header>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Skrining Pasien</button>
                            </li>
                            @if ($pasien->keterangan == 'Triase COVID (IGD)')
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Skrining Pasien IGD</button>
                            </li>

                            @endif
                            @if ($pasien->keterangan == 'Klinik TB')
                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Skrining Pasien TB</button>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <h4>DATA DIRI PASIEN</h4>
                                    <a href="{{ route('cetak.skrining-pasien-covid',$pasien->id) }}" type="button" class="btn btn-danger btn-icon-text">
                                        <i class="material-icons md-picture_as_pdf me-2 btn-icon-prepend"></i>
                                        Cetak PDF
                                    </a>
                                </div>
                                <hr>
                                 <!-- Tanggal dan Jam -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" readonly value="{{ $pasien->nama_lengkap }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="no_rm" class="form-label">No. RM</label>
                                            <input type="text" class="form-control" id="no_rm" name="no_rm" readonly value="{{ $pasien->no_rm }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tglLahir" name="tglLahir" value="{{ $pasien->tanggal_lahir }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" readonly>{{ $pasien->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Komorbid -->
                                        <div class="mb-3">
                                            <label for="komorbid" class="form-label">Komorbid</label>
                                            <input type="text" class="form-control" id="komorbid" name="komorbid" readonly value="{{ $pasien->komorbid }}" placeholder="Enter komorbid">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Pekerjaan -->
                                        <div class="mb-3">
                                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" readonly value="{{ $pasien->pekerjaan }}" placeholder="Enter Pekerjaan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Jenis Pasien -->
                                        <div class="mb-3">
                                            <label for="jenisPasien" class="form-label">Jenis Pasien</label>
                                            <select class="form-select" id="jenisPasien" name="jenisPasien">
                                            <option value="baru" {{ $pasien->jenis_pasien == 'baru' ? "selected" : "" }}>Baru</option>
                                            <option value="lama" {{ $pasien->jenis_pasien == 'lama' ? "selected" : "" }} >Lama</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Penjamin Biaya -->
                                        <div class="mb-3">
                                            <label for="penjaminBiaya" class="form-label">Penjamin Biaya</label>
                                            <select class="form-select" id="penjaminBiaya" name="penjaminBiaya">
                                            <option {{ $pasien->penjamin_biaya == 'umum' ? 'selected' : "" }} value="umum">Umum</option>
                                            <option {{ $pasien->penjamin_biaya == 'bpjs' ? 'selected' : "" }} value="bpjs">BPJS</option>
                                            <option {{ $pasien->penjamin_biaya == 'spm' ? 'selected' : "" }} value="spm">SPM</option>
                                            <option {{ $pasien->penjamin_biaya == 'jasa raharja' ? 'selected' : "" }} value="jasa_raharja">Jasa Raharja</option>
                                            <option {{ $pasien->penjamin_biaya == 'lainnya' ? 'selected' : "" }} value="lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Tujuan Pelayanan -->
                                        <div class="mb-3">
                                            <label for="tujuanPelayanan" class="form-label">Tujuan Pelayanan</label>
                                            <select class="form-select" id="tujuanPelayanan" name="tujuanPelayanan">
                                            <option {{ $pasien->tujuan == 'igd' ? 'selected' : '' }} value="igd">IGD</option>
                                            <option {{ $pasien->tujuan == 'airborne' ? 'selected' : '' }} value="airborne">Airborne</option>
                                            <option {{ $pasien->tujuan == 'poli klinik' ? 'selected' : '' }} value="poli_klinik">Poli Klinik</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if ($pasien->tujuan == 'poli klinik')
                                        <div class="col-md-6">
                                            <!-- Additional Field for Poli Klinik -->
                                            <div class="mb-3 d-none" id="poliKlinikGroup">
                                                <label for="poliKlinikTujuan" class="form-label">Poli Klinik Tujuan</label>
                                                <input type="text" readonly value="{{ $pasien->poli_tujuan }}" class="form-control" id="poliKlinikTujuan" name="poliKlinikTujuan" placeholder="Enter Poli Klinik Tujuan">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Skrining Awal -->
                                <h5>A. Skrining Awal (IGD dan Rawat Jalan)</h5>
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
                                <h4>Keterangan : <span id="keterangan">{{ $pasien->keterangan }}</span></h4>
                                <hr>
                                <!-- Skrining Lanjutan -->
                                <h5>B. Skrining Lanjutan (IGD dan Rawat Inap)</h5>
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
                                <h4>Keterangan: <span id="keteranganLanjutan">{{ $pasien->keterangan_lanjutan ?? '-' }}</span></h4>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                @isset($skrining_igd)
                                    <h5>Data Pasien</h5>
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
                                                <tr>
                                                    <td width="20%">Jenis Kelamin</td>
                                                    <td width="1%">:</td>
                                                    <td >
                                                        {{ $pasien->jenis_kelamin == "0" ? "Perempuan" : "Laki-Laki" }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
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
                                @endisset
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <h5>Data Pasien</h5>
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
                                            <tr>
                                                <td width="20%">Jenis Kelamin</td>
                                                <td width="1%">:</td>
                                                <td >
                                                    {{ $pasien->jenis_kelamin == "1" ? "Laki-Laki" : "Perempuan"}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                @isset($skrining_tb)
                                    <!-- Tanggal dan Jam -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                        <label for="tanggalKedatangan" class="form-label">Tanggal Kedatangan</label>
                                        <input type="date" class="form-control" value="{{ $skrining_tb->tanggal_kedatangan }}" id="tanggalKedatangan" name="tanggal_kedatangan">
                                        </div>
                                        <div class="col-md-6">
                                        <label for="jamDatang" class="form-label">Jam Datang</label>
                                        <input type="time" class="form-control" value="{{ $skrining_tb->jam_datang }}" id="jamDatang" name="jam_datang">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                        <label for="tanggalPeriksa" class="form-label">Tanggal Periksa</label>
                                        <input type="date" class="form-control" value="{{ $skrining_tb->tanggal_periksa }}" id="tanggalPeriksa" name="tanggal_periksa">
                                        </div>
                                        <div class="col-md-6">
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

                                @endisset

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-5">
            <a href="{{ route('skrining-covid.index') }}" class="btn btn-outline-danger">Kembali</a>
        </div>
        <!-- card end// -->
    </section>
</x-app-layout>
