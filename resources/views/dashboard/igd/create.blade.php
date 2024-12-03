<x-app-layout>
    @push('css')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    @endpush
    @push('js')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            $(function() {
                $('input[name="tanggal"]').daterangepicker({
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
    @endpush
    <section class="content-main mb-5">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(2))) }}</h2>
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
                            <h4>Tambah Data Skrining Pasien IGD</h4>
                        </div>
                    </header>
                    <div class="card-body">
                        <form action="{{ route('skrining-pasien-igd.update',$pasien->id) }}" method="POST">
                            @csrf
                            @method("PUT")
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
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-4">
                                                            <label for="product_name" class="form-label">Tempat Lahir</label>
                                                            <input placeholder="Masukkan data" type="text" value="{{ old('tempat_lahir') }}" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" />
                                                            @error('tempat_lahir')
                                                                <div class="invalid-feedback">
                                                                    {{$message}}.
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{ $pasien->tanggal_lahir }}
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
                                                <div class="row mb-4">
                                                    <label for="product_name" class="form-label">Jenis Kelamin</label>
                                                    <div class="col-md-4">
                                                        <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                                            <input class="form-check-input" id="jenis_kelamin" name="jenis_kelamin" value="0" {{ old('jenis_kelamin') == '0' ? "checked" : '' }} type="radio">
                                                            <span class="form-check-label"> Laki-Laki </span>
                                                        </label>
                                                        <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                                            <input class="form-check-input" id="jeni_kelamin" name="jenis_kelamin" value="1" {{ old('jenis_kelamin') == '1' ? "checked" : '' }} type="radio">
                                                            <span class="form-check-label"> Perempuan </span>
                                                        </label>
                                                        @error('jenis_kelamin')
                                                            <div class="invalid-feedback">
                                                                {{$message}}.
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
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
                                <input type="text" class="form-control" name="tanggal" />
                                </div>
                                <label class="col-sm-2 col-form-label">Jam</label>
                                <div class="col-sm-4">
                                <input type="time" class="form-control" name="jam" />
                                </div>
                            </div>
                            <hr>
                             <!-- Penilaian Awal -->
                            <h5>Penilaian Awal</h5>
                            <div class="mb-3">
                                <label class="form-label fw-bold">1. Primary Survey</label>
                                <div class="mb-2">
                                <label for="primary_survey_a" class="form-label">A (Airway)</label>
                                <input type="text" class="form-control" name="primary_survey_a" id="primary_survey_a" placeholder="Masukkan hasil penilaian" />
                                </div>
                                <div class="mb-2">
                                <label for="primary_survey_b" class="form-label">B (Breathing)</label>
                                <input type="text" class="form-control" name="primary_survey_b" id="primary_survey_b" placeholder="Masukkan hasil penilaian" />
                                </div>
                                <div class="mb-2">
                                <label for="primary_survey_c" class="form-label">C (Circulation)</label>
                                <input type="text" class="form-control" name="primary_survey_c" id="primary_survey_c" placeholder="Masukkan hasil penilaian" />
                                </div>
                                <div class="mb-2">
                                <label for="primary_survey_d" class="form-label">D (Disability)</label>
                                <input type="text" class="form-control" name="primary_survey_d" id="primary_survey_d" placeholder="Masukkan hasil penilaian" />
                                </div>
                                <div class="mb-2">
                                <label for="primary_survey_e" class="form-label">E (Exposure)</label>
                                <input type="text" class="form-control" name="primary_survey_e" id="primary_survey_e" placeholder="Masukkan hasil penilaian" />
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="secondary_survey" class="form-label fw-bold">2. Secondary Survey</label>
                                <textarea class="form-control" rows="3" name="secondary_survey" id="secondary_survey"></textarea>
                            </div>
                            <hr>
                            <!-- Tanda-tanda Vital -->
                            <div class="mb-3">
                                <label class="form-label">Tanda-tanda Vital</label>
                                <div class="row">
                                    <div class="col">
                                        <label for="td" class="form-label">TD (mmHg)</label>
                                        <input type="text" class="form-control" name="td" id="td" />
                                    </div>
                                    <div class="col">
                                        <label for="nadi" class="form-label">Nadi (/menit)</label>
                                        <input type="number" class="form-control" name="nadi" id="nadi" />
                                    </div>
                                    <div class="col">
                                        <label for="frekuensi_pernapasan" class="form-label">Frekuensi Pernapasan (/menit)</label>
                                        <input type="number" class="form-control" name="frekuensi_pernapasan" id="frekuensi_pernapasan" />
                                    </div>
                                    <div class="col">
                                        <label for="suhu" class="form-label">Suhu (°C)</label>
                                        <input type="number" step="0.1" class="form-control" name="suhu" id="suhu" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="saturasi_oksigen" class="form-label">Saturasi Oksigen</label>
                                <input type="number" class="form-control" name="saturasi_oksigen" id="saturasi_oksigen" />
                            </div>

                            <div class="mb-3">
                                <label for="riwayat_penyakit" class="form-label">Riwayat Penyakit / Pengobatan Sebelumnya</label>
                                <textarea class="form-control" rows="3" name="riwayat_penyakit" id="riwayat_penyakit"></textarea>
                            </div>
                            <hr>
                              <!-- Klasifikasi Pasien -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">3. Klasifikasi Pasien</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="klasifikasi_pasien" value="IGD" id="klasifikasi_igd" />
                                    <label class="form-check-label" for="klasifikasi_igd">IGD</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="klasifikasi_pasien" value="Poliklinik" id="klasifikasi_poliklinik" />
                                    <label class="form-check-label" for="klasifikasi_poliklinik">Poliklinik</label>
                                </div>
                            </div>
                            <hr>
                            <!-- Triage -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">4. Triage (ATS : Australian Triage Scale)</label>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="triage" value="ATS 1" id="ats_1" />
                                <label class="form-check-label" for="ats_1">ATS 1</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="triage" value="ATS 2" id="ats_2" />
                                <label class="form-check-label" for="ats_2">ATS 2</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="triage" value="ATS 3" id="ats_3" />
                                <label class="form-check-label" for="ats_3">ATS 3</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="triage" value="ATS 4" id="ats_4" />
                                <label class="form-check-label" for="ats_4">ATS 4</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="triage" value="ATS 5" id="ats_5" />
                                <label class="form-check-label" for="ats_5">ATS 5</label>
                                </div>
                            </div>
                            <hr>
                            <!-- Pemeriksaan Penunjang -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">5. Pemeriksaan Penunjang</label>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pemeriksaan_penunjang[]" value="EKG" id="ekg" />
                                <label class="form-check-label" for="ekg">EKG</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pemeriksaan_penunjang[]" value="Laboratorium" id="laboratorium" />
                                <label class="form-check-label" for="laboratorium">Laboratorium</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pemeriksaan_penunjang[]" value="Radiologi" id="radiologi" />
                                <label class="form-check-label" for="radiologi">Radiologi</label>
                                </div>
                            </div>
                            <hr>
                            <!-- Tindak Lanjut -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">6. Tindak Lanjut</label>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tindak_lanjut[]" value="Rawat" id="rawat" />
                                <label class="form-check-label" for="rawat">Rawat</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tindak_lanjut[]" value="Konsultasi" id="konsultasi" />
                                <label class="form-check-label" for="konsultasi">Konsultasi</label>
                                </div>
                            </div>

                        <div class="d-flex justify-content-end mb-5">
                            <button type="reset" class="btn btn-outline-danger">Batal</button>
                            <button type="submit" class="btn btn-primary mx-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
