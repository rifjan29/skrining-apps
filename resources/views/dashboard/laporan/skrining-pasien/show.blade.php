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
                            <h4>Detail Data Skrining Pasien</h4>
                        </div>

                    </header>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Skrining Pasien</button>
                            </li>
                            @if ($pasien->kondisi->status_kondisi == 'Diarahkan ke IGD')
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Skrining Pasien IGD</button>
                            </li>

                            @endif
                            @if ($pasien->kondisi->status_kondisi == 'Poli TB / Airborne IGD')
                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Skrining Pasien TB</button>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <h4>DATA DIRI PASIEN</h4>
                                            <a href="{{ route('cetak.skrining-pasien',$skrining->id) }}" type="button" class="btn btn-danger btn-icon-text">
                                                <i class="material-icons md-picture_as_pdf me-2 btn-icon-prepend"></i>
                                                Cetak PDF
                                            </a>
                                        </div>
                                        <hr>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label for="product_name" class="form-label fw-bold">No. RM</label>
                                                        <input readonly placeholder="Masukkan Data" readonly type="text" value="{{ old('no_rm',$pasien->no_rm ?? "-") }}" class="form-control @error('no_rm') is-invalid @enderror" name="no_rm" />
                                                        @error('no_rm')
                                                            <div class="invalid-feedback">
                                                                {{$message}}.
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label for="product_name" class="form-label fw-bold">Nama Lengkap</label>
                                                        <input readonly placeholder="Masukkan Data" readonly type="text" value="{{ old('nama',$pasien->nama_lengkap ?? "-") }}" class="form-control @error('nama') is-invalid @enderror" name="nama" />
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
                                                        <input readonly placeholder="Tanggal" readonly type="text"  value="{{ old('tgl',$pasien->tanggal_lahir ?? "-") }}" class="form-control @error('tgl') is-invalid @enderror" name="tgl" />
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
                                                        <textarea name="alamat" id="" readonly class="form-control" cols="30" placeholder="Masukkan Data" rows="10">{{ old('alamat',$pasien->alamat ?? "-") }}</textarea>
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
                                                        @php
                                                            $gejala = explode(',',$pasien->keluhan->gejala);
                                                        @endphp
                                                        <div>
                                                            <div class="form-check">
                                                                <input readonly readonly class="form-check-input" type="checkbox" {{ in_array('pusing',$gejala) ? 'checked' : '' }} name="gejala[]" value="pusing" id="pusing">
                                                                <label class="form-check-label" for="pusing">
                                                                Pusing
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input readonly class="form-check-input" type="checkbox" {{ in_array('nyeri_dada',$gejala) ? 'checked' : '' }} name="gejala[]" value="nyeri_dada" id="nyeri_dada">
                                                                <label class="form-check-label" for="nyeri_dada">
                                                                Nyeri Dada
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input readonly class="form-check-input" type="checkbox" {{ in_array('mual',$gejala) ? 'checked' : '' }} name="gejala[]" value="mual" id="mual">
                                                                <label class="form-check-label" for="mual">
                                                                Mual
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
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
                                                        <div>
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
                                                            <input readonly type="radio" name="question1"
                                                            @if (isset($pasien->ResikoJatuh))
                                                            {{ $pasien->ResikoJatuh->pertanyaan_satu == 'ya' ? 'checked' : ''  }}
                                                            @endif

                                                            value="ya" class="form-check-input">
                                                        </td>
                                                        <td class="text-center">
                                                            <input readonly type="radio" name="question1"
                                                            @if (isset($pasien->ResikoJatuh))
                                                            {{ $pasien->ResikoJatuh->pertanyaan_satu == 'tidak' ? 'checked' : ''  }}
                                                            @endif
                                                            value="tidak" class="form-check-input">
                                                        </td>
                                                        <td class="d-flex flex-row">
                                                            <div class="form-check">
                                                                <input readonly type="checkbox" class="form-check-input" id="tindakan1-1" name="tindakan1[]" value="Perlu Brancart"
                                                                @if (isset($pasien->ResikoJatuh))
                                                                {{ $pasien->ResikoJatuh->tindakan_satu == 'Perlu Brancart' ? 'checked' : '' }}
                                                                @endif
                                                                >
                                                                <label class="form-check-label" for="tindakan1-1" >Perlu Brancart</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input readonly type="checkbox" class="form-check-input" id="tindakan1-2" name="tindakan1[]" value="Perlu Kursi Roda"
                                                                @if (isset($pasien->ResikoJatuh))
                                                                {{ $pasien->ResikoJatuh->tindakan_dua == 'Perlu Kursi Roda' ? 'checked' : '' }}
                                                                @endif
                                                                >
                                                                <label class="form-check-label" for="tindakan1-2" >Perlu Kursi Roda</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Pertanyaan 2 -->
                                                    <tr class="border">
                                                        <td>Apakah pasien pernah jatuh dalam setahun terakhir?</td>
                                                        <td class="text-center">
                                                            <input readonly type="radio" name="question2"
                                                            @if (isset($pasien->ResikoJatuh))
                                                            {{ $pasien->ResikoJatuh->pertanyaan_dua == 'ya' ? 'checked' : ''  }}
                                                            @endif

                                                            value="ya" class="form-check-input">
                                                        </td>
                                                        <td class="text-center">
                                                            <input readonly type="radio" name="question2"
                                                            @if (isset($pasien->ResikoJatuh))
                                                            {{ $pasien->ResikoJatuh->pertanyaan_dua == 'tidak' ? 'checked' : ''  }}
                                                            @endif
                                                            value="tidak" class="form-check-input">
                                                        </td>
                                                        <td class="d-flex">
                                                            <div class="form-check">
                                                                <input readonly type="checkbox" class="form-check-input" id="tindakan2-1"
                                                                @if (isset($pasien->ResikoJatuh))
                                                                {{ $pasien->ResikoJatuh->tindakan_dua == 'Pasang Kalung Kuning' ? 'checked' : '' }}
                                                                @endif
                                                                name="tindakan2[]" value="Pasang Kalung Kuning">
                                                                <label class="form-check-label" for="tindakan2-1" >Pasang Kalung Kuning</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input readonly type="checkbox" class="form-check-input" id="tindakan2-2" name="tindakan2[]" value="Edukasi Cegah Jatuh"
                                                                @if (isset($pasien->ResikoJatuh))
                                                                {{ $pasien->ResikoJatuh->tindakan_dua == 'Edukasi Cegah Jatuh' ? 'checked' : '' }}
                                                                @endif
                                                                >
                                                                <label class="form-check-label" for="tindakan2-2">Edukasi Cegah Jatuh</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Pertanyaan 3 -->
                                                    <tr class="border">
                                                        <td>Apakah pasien merasa khawatir jatuh?</td>
                                                        <td class="text-center">
                                                            <input readonly type="radio" name="question3"
                                                            @if (isset($pasien->ResikoJatuh))
                                                            {{ $pasien->ResikoJatuh->pertanyaan_tiga == 'ya' ? 'checked' : ''  }}
                                                            @endif

                                                            value="ya" class="form-check-input">
                                                        </td>
                                                        <td class="text-center">
                                                            <input readonly type="radio" name="question3"
                                                            @if (isset($pasien->ResikoJatuh))
                                                            {{ $pasien->ResikoJatuh->pertanyaan_tiga == 'tidak' ? 'checked' : ''  }}
                                                            @endif

                                                            value="tidak" class="form-check-input">
                                                        </td>
                                                        <td class="d-flex">
                                                            <div class="form-check">
                                                                <input readonly type="checkbox" class="form-check-input" id="tindakan3-1"
                                                                @if (isset($pasien->ResikoJatuh))
                                                                {{ $pasien->ResikoJatuh->tindakan_tiga == 'Antrian dipercepat' ? 'checked' : '' }}
                                                                @endif
                                                                name="tindakan3[]" value="Antrian dipercepat">
                                                                <label class="form-check-label" for="tindakan3-1">Antrian dipercepat</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input readonly type="checkbox" class="form-check-input" id="tindakan3-2"
                                                                @if (isset($pasien->ResikoJatuh))

                                                                {{ $pasien->ResikoJatuh->tindakan_tiga == 'Pelayanan didahulukan' ? 'checked' : '' }}
                                                                @endif
                                                                name="tindakan3[]" value="Pelayanan didahulukan">
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
                                                    <input readonly class="form-check-input" type="radio" id="antrianDipercepat"
                                                    @if (isset($pasien->kebutuhan))
                                                    {{ $pasien->kebutuhan->status_kebutuhan == 'dipercepat' ? 'checked' : '' }}
                                                    @endif
                                                    name="antrian" value="dipercepat">
                                                    <label class="form-check-label" for="antrianDipercepat">
                                                        Antrian Dipercepat
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="radio" id="pelayananDidahulukan"
                                                    @if (isset($pasien->kebutuhan))
                                                    {{ $pasien->kebutuhan->status_kebutuhan == 'didahulukan' ? 'checked' : '' }}
                                                    @endif
                                                    name="antrian" value="didahulukan">
                                                    <label class="form-check-label" for="pelayananDidahulukan">
                                                        Pelayanan Didahulukan
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="radio" id="diarahkanKeIGD"
                                                    @if (isset($pasien->kebutuhan))
                                                    {{ $pasien->kebutuhan->status_kebutuhan == 'igd' ? 'checked' : '' }}
                                                    @endif
                                                    name="antrian" value="igd">
                                                    <label class="form-check-label" for="diarahkanKeIGD">
                                                        Diarahkan Ke IGD
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- SESUAI KEBUTUHAN -->
                                            @php
                                                $kebutuhan = [];
                                                if (isset($pasien->kebutuhan)){
                                                    $kebutuhan = explode(',',$pasien->kebutuhan->jenis_kebutuhan);
                                                }
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

                                            <!-- BILA ADA -->
                                            <div class="mb-3">
                                                <h6>Bila Ada</h6>
                                                <p>Jalankan SPO - <i>"Identifikasi Pasien Membahayakan Diri Dan Lingkungan"</i></p>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="radio"
                                                    @if (isset($pasien->kondisi))
                                                    {{ $pasien->kondisi->status_kondisi == 'Antrian Dipercepat' ? 'checked' : '' }}
                                                    @endif

                                                    id="antrianDipercepat2" name="bilaAda" value="dipercepat">
                                                    <label class="form-check-label" for="antrianDipercepat2">
                                                        Antrian Dipercepat
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="radio" id="pelayananDidahulukan2"
                                                    @if (isset($pasien->kondisi))
                                                    {{ $pasien->kondisi->status_kondisi == 'Pelayanan Didahulukan' ? 'checked' : '' }}
                                                    @endif
                                                    name="bilaAda" value="didahulukan">
                                                    <label class="form-check-label" for="pelayananDidahulukan2">
                                                        Pelayanan Didahulukan
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="radio" id="diarahkanKeIGD2"
                                                    @if (isset($pasien->kondisi))
                                                    {{ $pasien->kondisi->status_kondisi == 'Diarahkan ke IGD' ? 'checked' : '' }}
                                                    @endif
                                                    name="bilaAda" value="igd">
                                                    <label class="form-check-label" for="diarahkanKeIGD2">
                                                        Diarahkan Ke IGD
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input readonly class="form-check-input" type="radio" id="poliTB"
                                                    @if (isset($pasien->kondisi))
                                                    {{ $pasien->kondisi->status_kondisi == 'Poli TB / Airborne IGD' ? 'checked' : '' }}
                                                    @endif
                                                    name="bilaAda" value="poliTB">
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
                                                                        <input readonly class="form-check-input" type="radio"
                                                                        @if (isset($pasien->usia))
                                                                        {{ $pasien->usia->jenis_usia == 'balita' ? 'checked' : '' }}
                                                                        @endif
                                                                        name="usia" value="balita" id="balita">
                                                                        <label class="form-check-label" for="balita">
                                                                            Balita &lt; 2 tahun kondisi rewel, lemah, apatis
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="form-check">
                                                                        <input readonly class="form-check-input" type="radio" name="usia"
                                                                        @if (isset($pasien->usia))
                                                                        {{ $pasien->usia->jenis_usia == 'lansia' ? 'checked' : '' }}
                                                                        @endif
                                                                        value="lansia" id="lansia">
                                                                        <label class="form-check-label" for="lansia">
                                                                            Lansia, Usia &gt; 65 tahun
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input readonly type="checkbox" class="form-check-input" id="tindakan-usia"
                                                                @if (isset($pasien->usia))
                                                                {{ $pasien->usia->status_usia == true ? "checked" : '' }}
                                                                @endif
                                                                name="tindakan_usia" value="Antrian dipercepat">
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
                                                                <input readonly type="checkbox" class="form-check-input" {{ $pasien->bahasa->status_bahasa == true ? "checked" : '' }} id="tindakan-bahasa" name="tindakan_bahasa" value="Dibantu penerjemah (Verbal/Isyarat)">
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
                                                <input readonly type="checkbox" class="form-check-input"
                                                    @if (isset($pasien->FastTrack))
                                                    {{ $pasien->FastTrack->jenis_fast == true ? "checked" : "" }}
                                                    @endif
                                                id="fast-track" name="fast_track" value="FAST TRACK">
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
                                                        <input readonly type="checkbox" class="form-check-input" id="checkbox-diterima"
                                                        @if (isset($pasien->FastTrack))
                                                        {{ $pasien->FastTrack->kategori_fast == 'diterima' ? 'checked' : '' }}
                                                        @endif
                                                        name="hasil_keputusan" onchange="toggleTextarea('diterima')" value="diterima">
                                                        <label class="form-check-label fw-bold" for="checkbox-diterima">Pasien DITERIMA</label>
                                                        <p>Tempat Pelayanan</p>
                                                    </div>
                                                    <textarea id="textarea-diterima" name="textarea_diterima" class="form-control
                                                        @if (isset($pasien->FastTrack))
                                                        {{ $pasien->FastTrack->kategori_fast == 'diterima' ? '' : 'hidden' }} mt-2"
                                                        @endif
                                                        placeholder="Masukkan tempat pelayanan">
                                                        @if (isset($pasien->FastTrack))
                                                        {{ $pasien->FastTrack->kategori_fast == "diterima" ? $pasien->FastTrack->rujukan : '' }}
                                                        @endif
                                                    </textarea>
                                                </div>

                                                <!-- Pasien TIDAK DIANJURKAN -->
                                                <div class="col-md-4">
                                                    <div class="form-check text-start">
                                                        <input readonly type="checkbox" class="form-check-input" id="checkbox-tidak-dianjurkan"
                                                        @if (isset($pasien->FastTrack))

                                                        {{ $pasien->FastTrack->kategori_fast == 'tidak dianjurkan' ? 'checked' : '' }}
                                                        @endif
                                                        name="hasil_keputusan" onchange="toggleTextarea('tidak-dianjurkan')" value="tidak dianjurkan">
                                                        <label class="form-check-label fw-bold" for="checkbox-tidak-dianjurkan">Pasien TIDAK DIANJURKAN</label>
                                                        <p>Alternatif yang dianjurkan</p>
                                                    </div>
                                                    <textarea id="textarea-tidak-dianjurkan" name="textarea_tidak_dianjurkan" class="form-control
                                                        @if (isset($pasien->FastTrack))
                                                        {{ $pasien->FastTrack->kategori_fast == 'tidak dianjurkan' ? '' : 'hidden' }}
                                                        @endif
                                                     mt-2" placeholder="Masukkan alternatif yang dianjurkan">
                                                     @if (isset($pasien->FastTrack))
                                                     {{ $pasien->FastTrack->kategori_fast == "tidak dianjurkan" ? $pasien->FastTrack->rujukan : '' }}
                                                     @endif
                                                    </textarea>
                                                </div>

                                                <!-- Pasien DIRUJUK -->
                                                <div class="col-md-4">
                                                    <div class="form-check text-start">
                                                        <input readonly type="checkbox" class="form-check-input" id="checkbox-dirujuk"
                                                        @if (isset($pasien->FastTrack))
                                                        {{ $pasien->FastTrack->kategori_fast == 'dirujuk' ? 'checked' : '' }}
                                                        @endif
                                                        name="hasil_keputusan" onchange="toggleTextarea('dirujuk')" value="dirujuk">
                                                        <label class="form-check-label fw-bold" for="checkbox-dirujuk">Pasien DIRUJUK</label>
                                                        <p>Tempat Rujukan</p>
                                                    </div>
                                                    <textarea id="textarea-dirujuk" name="textarea_dirujuk" class="form-control
                                                        @if (isset($pasien->FastTrack))
                                                        {{ $pasien->FastTrack->kategori_fast == 'dirujuk' ? '' : 'hidden' }}
                                                        @endif
                                                     mt-2" placeholder="Masukkan tempat rujukan">
                                                     @if (isset($pasien->FastTrack))
                                                     {{ $pasien->FastTrack->rujukan }}
                                                     @endif
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label fw-bold">Nama Terang Petugas</label>
                                                <input readonly type="text" class="form-control" readonly value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                @isset($skrining_igd)
                                    <div class="d-flex justify-content-between">
                                        <h5>Data Pasien</h5>
                                        <a href="{{ route('cetak.skrining-pasien.igd',$skrining->id) }}" type="button" class="btn btn-danger btn-icon-text">
                                            <i class="material-icons md-picture_as_pdf me-2 btn-icon-prepend"></i>
                                            Cetak PDF
                                        </a>
                                    </div>
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
                                <div class="d-flex justify-content-between">
                                    <h5>Data Pasien</h5>
                                    <a href="{{ route('cetak.skrining-pasien.tb',$skrining->id) }}" type="button" class="btn btn-danger btn-icon-text">
                                        <i class="material-icons md-picture_as_pdf me-2 btn-icon-prepend"></i>
                                        Cetak PDF
                                    </a>
                                </div>
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
            <a href="{{ route('skrining-pasien.index') }}" class="btn btn-outline-danger">Kembali</a>
        </div>
        <!-- card end// -->
    </section>
</x-app-layout>
