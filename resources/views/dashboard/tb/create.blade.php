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
                $('input[name="tanggal_kedatangan"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: false,
                    timePicker: false,
                    startDate: moment().startOf('hour'),
                    locale: {
                            format: 'Y-MM-DD'
                        }
                });

                $('input[name="tanggal_periksa"]').daterangepicker({
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
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(2))) }} Skrining Pasien</h2>
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
                            <h4>Tambah Data Skrining Pasien TB</h4>
                        </div>

                    </header>
                    <div class="card-body">
                        <form action="{{ route('skrining-tb.store',$pasien->id) }}" method="POST">
                            @csrf
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
                            <div class="row mb-3">
                                <div class="col-md-6">
                                <label for="tanggalKedatangan" class="form-label">Tanggal Kedatangan</label>
                                <input placeholder="Tanggal" type="text" id="tanggalKedatangan"  value="{{ old('tanggal_kedatangan') }}" class="form-control @error('tanggal_kedatangan') is-invalid @enderror" name="tanggal_kedatangan" />
                                </div>
                                <div class="col-md-6">
                                <label for="jamDatang" class="form-label">Jam Datang</label>
                                <input type="time" class="form-control" id="jamDatang" name="jam_datang">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                <label for="tanggalPeriksa" class="form-label">Tanggal Periksa</label>
                                <input type="text" class="form-control" id="tanggalPeriksa" name="tanggal_periksa">
                                </div>
                                <div class="col-md-6">
                                <label for="jamPeriksa" class="form-label">Jam Periksa</label>
                                <input type="time" class="form-control" id="jamPeriksa" name="jam_periksa">
                                </div>
                            </div>

                            <!-- Tanda dan Gejala -->
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanda dan Gejala TB</th>
                                    <th>Ya</th>
                                    <th>Tidak</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Batuk Berdahak selama &gt; 2-3 Minggu</td>
                                    <td><input type="radio" name="gejala1" value="ya"></td>
                                    <td><input type="radio" name="gejala1" value="tidak"></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Batuk Berdarah</td>
                                    <td><input type="radio" name="gejala2" value="ya"></td>
                                    <td><input type="radio" name="gejala2" value="tidak"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Demam Hilang Timbul &gt; 1 bulan</td>
                                    <td><input type="radio" name="gejala3" value="ya"></td>
                                    <td><input type="radio" name="gejala3" value="tidak"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Keringat malam tanpa aktivitas</td>
                                    <td><input type="radio" name="gejala4" value="ya"></td>
                                    <td><input type="radio" name="gejala4" value="tidak"></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Penurunan berat badan tanpa penyebab yang jelas</td>
                                    <td><input type="radio" name="gejala5" value="ya"></td>
                                    <td><input type="radio" name="gejala5" value="tidak"></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Pembesaran kelenjar getah bening</td>
                                    <td><input type="radio" name="gejala6" value="ya"></td>
                                    <td><input type="radio" name="gejala6" value="tidak"></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Sesak napas dan nyeri dada</td>
                                    <td><input type="radio" name="gejala7" value="ya"></td>
                                    <td><input type="radio" name="gejala7" value="tidak"></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Pernah minum obat paru dalam waktu lama sebelumnya</td>
                                    <td><input type="radio" name="gejala8" value="ya"></td>
                                    <td><input type="radio" name="gejala8" value="tidak"></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Ada keluarga/tetangga yang pernah sakit paru/TB/Pengobatan paru dalam jangka waktu yang lama</td>
                                    <td><input type="radio" name="gejala9" value="ya"></td>
                                    <td><input type="radio" name="gejala9" value="tidak"></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Penyakit Lain: <br> &bull; Asma <br> &bull; DM <br> &bull; HIV</td>
                                    <td><input type="radio" name="gejala10" value="ya"></td>
                                    <td><input type="radio" name="gejala10" value="tidak"></td>
                                </tr>
                                </tbody>
                            </table>

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
