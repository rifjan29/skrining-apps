<?php

namespace App\Http\Controllers;

use App\Models\PasienCovid;
use App\Models\SkriningAwal;
use App\Models\SkriningLanjutan;
use App\Models\SkriningPasienIGD;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SkriningPasienCovidController extends Controller
{
    public function index() {

        $data = PasienCovid::latest()->get();
        return view('dashboard.skrining-covid.index',compact('data'));
    }

    public function create() {
        return view('dashboard.skrining-covid.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tglLahir' => 'required|date|before:today',
            'alamat' => 'required|string|max:255',
            'komorbid' => 'nullable|string|max:255',
            'jenisPasien' => 'required|in:baru,lama',
            'penjaminBiaya' => 'required|in:umum,bpjs,spm,jasa_raharja',
            'gejala1' => 'required|in:0,1,5',
            'gejala2' => 'required|in:0,1,5',
            'gejala3' => 'required|in:0,1,5',
            'gejala4' => 'required|in:0,1,5',
            'gejala_lanjutan1' => 'required|in:0,1,5',
            'gejala_lanjutan2' => 'required|in:0,1,5',
            'gejala_lanjutan3' => 'required|in:0,1,5',
            'gejala_lanjutan4' => 'required|in:0,1,5',
            'gejala_lanjutan5' => 'required|in:0,1,5',
            'gejala_lanjutan6' => 'required|in:0,1,5',
            'gejala_lanjutan7' => 'required|in:0,1,5',
            'gejala_lanjutan8' => 'required|in:0,1,5',
            'gejala_lanjutan9' => 'required|in:0,1,5',
        ]);
        try {
            DB::beginTransaction();
            $transactionCode = PasienCovid::generateTransactionCode();
            $pasien = new PasienCovid;
            $pasien->kode_transaksi = $transactionCode;
            $pasien->no_rm = $request->get('no_rm');
            $pasien->nama_lengkap = $request->get('nama');
            $pasien->tanggal_lahir = $request->get('tglLahir');
            $pasien->pekerjaan = $request->get('pekerjaan');
            $pasien->alamat = $request->get('alamat');
            $pasien->komorbid = $request->get('komorbid');
            $pasien->jenis_pasien = $request->get('jenisPasien');
            $pasien->penjamin_biaya = $request->get('penjaminBiaya') == 'jasa_raharja' ? 'jasa raharja' : $request->get('penjaminBiaya');
            $pasien->tujuan = $request->get('tujuanPelayanan') == 'poli_klinik' ? 'poli klinik' : $request->get('tujuanPelayanan');
            $pasien->poli_tujuan = $request->has('poliKlinikTujuan') && $request->get('poliKlinikTujuan') != null ? $request->get('poliKlinikTujuan') : null;
            $pasien->user_id = Auth::user()->id;
            $pasien->keterangan = $request->get('keterangan') != null ? $request->get('keterangan') : null;
            $pasien->keterangan_lanjutan = $request->get('keterangan_lanjutan') != null || $request->get('keterangan_lanjutan') != '-' ? $request->get('keterangan_lanjutan') : null;
            $pasien->total_skor_awal = $request->get('skor_awal');
            $pasien->total_skor_lanjutan = $request->get('total_skor_lanjutan');
            $pasien->save();

            $pasien_id = $pasien->id;
            // skrining awal
            $gejala = [
                'gejala1',
                'gejala2',
                'gejala3',
                'gejala4'
            ];

            foreach ($gejala as $gejala_item) {
                $skrining_awal = new SkriningAwal;
                $skrining_awal->pasien_id = $pasien_id;
                $skrining_awal->pilihan = $request->get($gejala_item) == '1' ? "Ya" : "Tidak";
                $skrining_awal->skor = (int) $request->get($gejala_item);
                $skrining_awal->save();
            }

            $gejala_lanjutan = [
                'gejala_lanjutan1',
                'gejala_lanjutan2',
                'gejala_lanjutan3',
                'gejala_lanjutan4',
                'gejala_lanjutan5',
                'gejala_lanjutan6',
                'gejala_lanjutan7',
                'gejala_lanjutan8',
                'gejala_lanjutan9',
            ];
            foreach ($gejala_lanjutan as $gejala_lanjutan_item) {
                // skrining lanjutan
                $skrining_lanjutan = new SkriningLanjutan;
                $skrining_lanjutan->pasien_id = $pasien_id;
                $skrining_lanjutan->pilihan = $request->get($gejala_lanjutan_item) != '0' ? "Ya" : "Tidak";;
                $skrining_lanjutan->skor = (int) $request->get($gejala_lanjutan_item);
                $skrining_lanjutan->save();
            }

            DB::commit();
            return redirect()->route('skrining-covid.index')->withStatus('Berhasil menambahkan data.');

        } catch (Exception $th) {
            DB::rollBack();
            return redirect()->route('skrining-covid.index')->withError('Terjadi kesalahan.');
        }


    }

    public function show($id) {
        $pasien = PasienCovid::find($id);
        $skrining_awal = SkriningAwal::where('pasien_id',$pasien->id)->get();
        $skrining_lanjutan = SkriningLanjutan::where('pasien_id',$pasien->id)->get();
        $skrining_igd = null;
        if ($pasien->keterangan == 'Triase COVID (IGD)') {
            $skrining_igd = SkriningPasienIGD::where('pasien_id',$pasien->id)->first();
        }

        return view('dashboard.skrining-covid.show',compact('pasien','skrining_awal','skrining_lanjutan','skrining_igd'));
    }
}
