<x-app-layout>
    @push('js')
        <script>
            $(document).ready(function () {
                // Function to calculate total score
                function calculateScore() {
                    let totalScore = 0;
                    let keterangan = ''
                    // Iterate through all checked radio buttons with class 'gejala'
                    $('.gejala:checked').each(function () {
                        totalScore += parseInt($(this).val()); // Add the value of the checked radio button
                    });
                    let poli = $('#tujuanPelayanan :selected').val();

                    // Update the total score display
                    $('#totalSkriningAwal').text(totalScore);

                    if (totalScore > 3 ) {
                        if (poli === 'igd') {
                            keterangan = 'Triase COVID (IGD)';
                        } else if (poli === 'poli_klinik') {
                            keterangan = 'Klinik TB';
                            $('#poliKlinikGroup').removeClass('d-none');
                            $('#poliKlinikTujuan').val(keterangan)
                        }
                    }else{
                        // Reset the keterangan and hide Poli Klinik group
                        $('#poliKlinikGroup').addClass('d-none');
                        $('#poliKlinikTujuan').val(''); // Clear Poli Klinik Tujuan input
                    }
                    // Update the keterangan display
                    $('#keterangan').text(keterangan);
                    $('.keterangan_input').val(keterangan)
                    $('.skor_awal').val(totalScore);
                }

                // Attach event listener to all radio buttons with class 'gejala'
                $('.gejala').on('change', calculateScore);


                $('#tujuanPelayanan').on('change', function () {
                    // Initial calculation to ensure score starts from 0
                    calculateScore();
                    if ($(this).val() === 'poli_klinik') {
                        $('#poliKlinikGroup').removeClass('d-none');
                    } else {
                        $('#poliKlinikGroup').addClass('d-none');
                        $('#poliKlinikTujuan').val(''); // Clear the input if hidden
                    }
                });

                // calculateScoreLanjutan
                function calculateScoreLanjutan() {
                    let totalScoreLanjutan = 0;

                    // Iterate through all selected radio buttons with class 'gejala'
                    $('.gejalaLanjutan:checked').each(function () {
                        totalScoreLanjutan += parseInt($(this).val());
                    });

                    // Update the total score display
                    $('#totalSkriningLanjutan').text(totalScoreLanjutan);

                    // Update the keterangan based on total score
                    let keteranganLanjutan = '-'
                    if (totalScoreLanjutan > 10) {
                        keteranganLanjutan = 'Sangat mungkin Covid / Suspek Covid. Pasien dikonsulkan ke DPJP Covid.';
                        $('#keteranganLanjutan').text(keteranganLanjutan);
                    } else {
                        keteranganLanjutan = '-';
                        $('#keteranganLanjutan').text(keteranganLanjutan);
                    }
                    $('.skor_lanjutan').val(totalScoreLanjutan);
                    $('.inputketeranganLanjutan').val(keteranganLanjutan)
                }


                // Attach event listeners to all radio buttons with class 'gejala'
                $(document).on('change', '.gejalaLanjutan', calculateScoreLanjutan);
            });
        </script>
    @endpush
    <section class="content-main mb-5">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(3))) }} Skrining Pasien Covid</h2>
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
                        <form action="{{ route('skrining-covid.store') }}" method="POST">
                        @csrf
                        <!-- Tanggal dan Jam -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control border" id="nama" name="nama" placeholder="Masukkan Data" />
                        </div>
                        <div class="mb-3">
                            <label for="no_rm" class="form-label">No. RM</label>
                            <input type="text" class="form-control border" placeholder="Masukkan Data" id="no_rm" name="no_rm" />
                        </div>
                        <div class="mb-3">
                            <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control border" placeholder="Masukkan Data" id="tglLahir" name="tglLahir" />
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control border" placeholder="Masukkan Data" id="alamat" name="alamat"></textarea>
                        </div>
                        <!-- Komorbid -->
                        <div class="mb-3">
                            <label for="komorbid" class="form-label">Komorbid</label>
                            <input type="text" class="form-control border" id="komorbid" name="komorbid" placeholder="Enter komorbid">
                        </div>

                        <!-- Pekerjaan -->
                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control border" id="pekerjaan" name="pekerjaan" placeholder="Enter Pekerjaan">
                        </div>

                        <!-- Jenis Pasien -->
                        <div class="mb-3">
                            <label for="jenisPasien" class="form-label">Jenis Pasien</label>
                            <select class="form-select border" id="jenisPasien" name="jenisPasien">
                            <option value="baru">Baru</option>
                            <option value="lama">Lama</option>
                            </select>
                        </div>

                        <!-- Penjamin Biaya -->
                        <div class="mb-3">
                            <label for="penjaminBiaya" class="form-label">Penjamin Biaya</label>
                            <select class="form-select border" id="penjaminBiaya" name="penjaminBiaya">
                            <option value="umum">Umum</option>
                            <option value="bpjs">BPJS</option>
                            <option value="spm">SPM</option>
                            <option value="jasa_raharja">Jasa Raharja</option>
                            <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <!-- Tujuan Pelayanan -->
                        <div class="mb-3">
                            <label for="tujuanPelayanan" class="form-label">Tujuan Pelayanan</label>
                            <select class="form-select border" id="tujuanPelayanan" name="tujuanPelayanan">
                            <option value="igd">IGD</option>
                            <option value="airborne">Airborne</option>
                            <option value="poli_klinik">Poli Klinik</option>
                            </select>
                        </div>

                        <!-- Additional Field for Poli Klinik -->
                        <div class="mb-3 d-none" id="poliKlinikGroup">
                            <label for="poliKlinikTujuan" class="form-label">Poli Klinik Tujuan</label>
                            <input type="text" class="form-control border" id="poliKlinikTujuan" name="poliKlinikTujuan" placeholder="Enter Poli Klinik Tujuan">
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
                                <tr class="border">
                                <td>1</td>
                                <td>Demam / Menggigil / Gejala 1 minggu terakhir</td>
                                <td>
                                    <input type="radio" name="gejala1" value="1" class="form-check-input gejala" />
                                </td>
                                <td>
                                    <input type="radio" name="gejala1" value="0" class="form-check-input gejala" />
                                </td>
                                </tr>
                                <tr class="border">
                                <td>2</td>
                                <td>Batuk / Pilek / Sakit Tenggorokan</td>
                                <td>
                                    <input type="radio" name="gejala2" value="1" class="form-check-input gejala" />
                                </td>
                                <td>
                                    <input type="radio" name="gejala2" value="0" class="form-check-input gejala" />
                                </td>
                                </tr>
                                <tr class="border">
                                <td>3</td>
                                <td>Sesak Napas</td>
                                <td>
                                    <input type="radio" name="gejala3" value="1" class="form-check-input gejala" />
                                </td>
                                <td>
                                    <input type="radio" name="gejala3" value="0" class="form-check-input gejala" />
                                </td>
                                </tr>
                                <tr class="border">
                                <td>4</td>
                                <td>Riwayat Kontak erat dengan pasien Confirm Covid-19</td>
                                <td>
                                    <input type="radio" name="gejala4" value="1" class="form-check-input gejala" />
                                </td>
                                <td>
                                    <input type="radio" name="gejala4" value="0" class="form-check-input gejala" />
                                </td>
                                </tr>
                            </tbody>
                            <tfoot class="border">
                                <tr>
                                <th colspan="3" class="text-end">Total Skor</th>
                                <th><span id="totalSkriningAwal">0</span></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                        <h4>Keterangan : <span id="keterangan"></span></h4>
                        <input hidden type="text" name="keterangan" class="keterangan_input">
                        <input hidden type="text" name="skor_awal" class="skor_awal">
                        <hr>
                        <!-- Skrining Lanjutan -->
                        <h5>B. Skrining Lanjutan (IGD dan Rawat Inap)</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered border">
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
                                    <tr class="border">
                                        <td>1</td>
                                        <td>Riwayat kontak erat pasien Confirm Covid-19</td>
                                        <td><input type="radio" name="gejala_lanjutan1" class="gejalaLanjutan" value="5"></td>
                                        <td><input type="radio" name="gejala_lanjutan1" class="gejalaLanjutan" value="0"></td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="border">
                                        <td>2</td>
                                        <td>Pria</td>
                                        <td><input type="radio" name="gejala_lanjutan2" class="gejalaLanjutan" value="1"></td>
                                        <td><input type="radio" name="gejala_lanjutan2" class="gejalaLanjutan" value="0"></td>
                                        <td>1</td>
                                    </tr>
                                    <tr class="border">
                                        <td>3</td>
                                        <td>Usia lebih dari 44 tahun</td>
                                        <td><input type="radio" name="gejala_lanjutan3" class="gejalaLanjutan" value="1"></td>
                                        <td><input type="radio" name="gejala_lanjutan3" class="gejalaLanjutan" value="0"></td>
                                        <td>1</td>
                                    </tr>
                                    <tr class="border">
                                        <td>4</td>
                                        <td>Sumer (37.8 °C)</td>
                                        <td><input type="radio" name="gejala_lanjutan4" class="gejalaLanjutan" value="1"></td>
                                        <td><input type="radio" name="gejala_lanjutan4" class="gejalaLanjutan" value="0"></td>
                                        <td>1</td>
                                    </tr>
                                    <tr class="border">
                                        <td>5</td>
                                        <td>Demam tinggi lebih dari 38.5 °C</td>
                                        <td><input type="radio" name="gejala_lanjutan5" class="gejalaLanjutan" value="3"></td>
                                        <td><input type="radio" name="gejala_lanjutan5" class="gejalaLanjutan" value="0"></td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="border">
                                        <td>6</td>
                                        <td>Batuk / Pilek / Diare / Hilang rasa bau (Anosmia)</td>
                                        <td><input type="radio" name="gejala_lanjutan6" class="gejalaLanjutan" value="1"></td>
                                        <td><input type="radio" name="gejala_lanjutan6" class="gejalaLanjutan" value="0"></td>
                                        <td>1</td>
                                    </tr>
                                    <tr class="border">
                                        <td>7</td>
                                        <td>Sesak SpO2 kurang dari 95%</td>
                                        <td><input type="radio" name="gejala_lanjutan7" class="gejalaLanjutan" value="5"></td>
                                        <td><input type="radio" name="gejala_lanjutan7" class="gejalaLanjutan" value="0"></td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="border">
                                        <td>8</td>
                                        <td>NLR (% Neutrofil dibagi % Limfosit) ≥ 5.8</td>
                                        <td><input type="radio" name="gejala_lanjutan8" class="gejalaLanjutan" value="1"></td>
                                        <td><input type="radio" name="gejala_lanjutan8" class="gejalaLanjutan" value="0"></td>
                                        <td>1</td>
                                    </tr>
                                    <tr class="border">
                                        <td>9</td>
                                        <td>Pneumonia pada foto thorax</td>
                                        <td><input type="radio" name="gejala_lanjutan9" class="gejalaLanjutan" value="5"></td>
                                        <td><input type="radio" name="gejala_lanjutan9" class="gejalaLanjutan" value="0"></td>
                                        <td>5</td>
                                    </tr>
                                </tbody>
                                <tfoot class="border">
                                    <tr>
                                    <th colspan="3" class="text-end">Total Skor</th>
                                    <th><span id="totalSkriningLanjutan">0</span></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <h4>Keterangan: <span id="keteranganLanjutan">-</span></h4>
                        <input hidden type="text" name="keterangan_lanjutan" class="inputketeranganLanjutan">
                        <input hidden type="text" name="total_skor_lanjutan" class="skor_lanjutan">
                    </div>

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-5">
            <button type="reset" class="btn btn-outline-danger">Batal</button>
            <button type="submit" class="btn btn-primary mx-2">Simpan</button>
        </form>

        </div>
    </section>
</x-app-layout>
