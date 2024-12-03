<?php

namespace App\Http\Controllers;

use App\Models\Bahasa;
use App\Models\FastTrack;
use App\Models\GangguanFungsiOrgan;
use App\Models\Kebutuhan;
use App\Models\Keluhan;
use App\Models\Kondisi;
use App\Models\Pasien;
use App\Models\PrivasiTertentu;
use App\Models\ResikoJatuh;
use App\Models\SkriningPasien;
use App\Models\SkriningPasienIGD;
use App\Models\SkriningPasienTB;
use App\Models\Usia;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SkriningPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SkriningPasien::with('pasien')->latest()->get();
        return view('dashboard.skrinning.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.skrinning.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_rm' => 'required',
            'nama' => 'required',
            'tgl' => 'required',
            'alamat' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $transactionCode = SkriningPasien::generateTransactionCode();

            $pasien = new Pasien;
            $pasien->no_rm = $request->get('no_rm');
            $pasien->nama_lengkap = $request->get('nama');
            $pasien->tanggal_lahir = Carbon::parse($request->get('tgl'));
            $pasien->alamat = $request->get('alamat');
            $pasien->save();
            $id_pasien = $pasien->id;

            $status_transaksi = 'pending';
            if ($request->get('bilaAda') == 'dipercepat' || $request->get('didahulukan')) {
                $status_transaksi = 'selesai';
            }else if($request->get('bilaAda') == 'igd'){
                $status_transaksi = 'pending_igd';
            }else if($request->get('bilaAda') == 'poliTB'){
                $status_transaksi = 'pending_tb';
            }else{
                $status_transaksi = 'batal';
            }
            $transaksi = new SkriningPasien;
            $transaksi->kode_skrining =  $transactionCode;
            $transaksi->pasien_id = $id_pasien;
            $transaksi->user_id = Auth::user()->id;
            $transaksi->tanggal_skrining = Carbon::now();
            $transaksi->status_skrining = $status_transaksi;
            $transaksi->ttd = null;
            $transaksi->save();

            // KELUHAN
            $gejala = implode(', ', $request->get('gejala'));
            $keluhan = new Keluhan;
            $keluhan->pasien_id = $id_pasien;
            $keluhan->gejala = $gejala;
            $keluhan->skala = (int) $request->get('feeling');
            $keluhan->save();

            // KONDISI
            $status_kondisi = null;
            if ($request->get('bilaAda') == 'dipercepat') {
                $status_kondisi = 'Antrian Dipercepat';
            }else if($request->get('bilaAda') == 'didahulukan'){
                $status_kondisi == 'Pelayanan Didahulukan';
            }else if($request->get('bilaAda') == 'igd'){
                $status_kondisi = 'Diarahkan ke IGD';
            }else if($request->get('bilaAda') == 'poliTB'){
                $status_kondisi = 'Poli TB / Airborne IGD';
            }else{
                $status_kondisi = null;
            }
            $kondisi = new Kondisi;
            $kondisi->pasien_id = $id_pasien;
            $kondisi->jenis = $request->get('peny_menular');
            $kondisi->perilaku = implode(',',$request->get('gang_kejiwaan'));
            $kondisi->status_kondisi = $status_kondisi;
            $kondisi->save();

            // SKRINING RESIKO JATUH
            $resiko_jatuh = new ResikoJatuh;
            $resiko_jatuh->pasien_id = $id_pasien;
            $resiko_jatuh->pertanyaan_satu = $request->get('question1');
            $resiko_jatuh->pertanyaan_dua = $request->get('question2');
            $resiko_jatuh->pertanyaan_tiga = $request->get('question3');
            $resiko_jatuh->status_resiko = null;
            $resiko_jatuh->tindakan_satu = $request->has('tindakan1') ? implode(',',$request->get('tindakan1')) : null;
            $resiko_jatuh->tindakan_dua = $request->has('tindakan2') ? implode(',',$request->get('tindakan2')) : null;
            $resiko_jatuh->tindakan_tiga = $request->has('tindakan3') ? implode(',',$request->get('tindakan3')) : null;
            $resiko_jatuh->save();

            // USIA
            $usia  = new Usia;
            $usia->pasien_id = $id_pasien;
            $usia->jenis_usia = $request->get('usia') ?? null;
            $usia->status_usia = $request->has('tindakan_usia') ? true : false;
            $usia->save();

            // GANGGUAN FUNGSI ORGAN
            $gangguan = new GangguanFungsiOrgan;
            $gangguan->pasien_id = $id_pasien;
            $gangguan->jenis_gangguan = $request->get('gangguan') ?? null;
            $gangguan->status_gangguan = $request->has('tindakan_gangguan') ? true : false;
            $gangguan->save();

            // KEBUTUHAN
            $kebutuhan = new Kebutuhan;
            $kebutuhan->pasien_id = $id_pasien;
            $kebutuhan->status_kebutuhan = $request->get('antrian');
            $kebutuhan->jenis_kebutuhan = $request->get('kebutuhan');
            $kebutuhan->save();

            // PRIVASI TERTENTU
            $privasi = new PrivasiTertentu;
            $privasi->pasien_id = $id_pasien;
            $privasi->jenis_privasi = $request->get('privasi_tertentu') ?? null;
            $privasi->status_privasi = $request->has('tindakan_privasi') ? true : false;
            $privasi->save();

            // BAHASA
            $bahasa = new Bahasa;
            $bahasa->pasien_id = $id_pasien;
            $bahasa->jenis_bahasa = $request->get('tindakan_bahasa') ?? null;
            $bahasa->status_bahasa = $request->has('tindakan_bahasa') ? true : false;
            $bahasa->save();

            // FAST TRACK
            $rujukan = null;
            if ($request->get('hasil_keputusan') == 'diterima') {
                $rujukan = $request->get('textarea_diterima');
            }else if($request->get('hasil_keputusan') == 'tidak dianjurkan') {
                $rujukan = $request->get('textarea_tidak_dianjurkan');
            }else if($request->get('hasil_keputusan') == 'dirujuk') {
                $rujukan = $request->get('textarea_dirujuk');
            }else{
                $rujukan = null;
            };
            $fast = new FastTrack;
            $fast->pasien_id = $id_pasien;
            $fast->jenis_fast = $request->has('fast_track') ? true : false;
            $fast->kategori_fast = $request->get('hasil_keputusan') ?? null;
            $fast->status_fast = $request->get('hasil_keputusan') ?? null;
            $fast->rujukan = $rujukan;
            $fast->save();
            DB::commit();
            return redirect()->route('skrining-pasien.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $th) {
            return $th;
            DB::rollBack();
            return redirect()->route('skrining-pasien.index')->withError('Terjadi kesalahan.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $skrining = SkriningPasien::find($id);
        $pasien = Pasien::with([
            'Keluhan',
            'Kondisi',
            'ResikoJatuh',
            'Usia',
            'GangguanFungsiOrgan',
            'PrivasiTertentu',
            'Bahasa',
            'FastTrack',
            'Kebutuhan'
        ])->find($skrining->pasien_id);

        $skrining_tb = null;
        if ($pasien->kondisi->status_kondisi == 'Poli TB / Airborne IGD') {
            $skrining_tb = SkriningPasienTB::where('pasien_id',$skrining->pasien_id)->first();
        }

        $skrining_igd = null;
        if ($pasien->Kondisi->status_kondisi == 'Diarahkan ke IGD') {
            $skrining_igd = SkriningPasienIGD::where('pasien_id',$skrining->pasien_id)->first();
        }
        return view('dashboard.skrinning.show',compact('pasien','skrining_tb','skrining_igd'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $skrining_tb = SkriningPasienTB::where('pasien_id',$id)->first();
            $skrining_tb->tanggal_kedatangan = $request->get('tanggal_kedatangan');
            $skrining_tb->tanggal_periksa = $request->get('tanggal_periksa');
            $skrining_tb->jam_datang = $request->get('jam_datang');
            $skrining_tb->jam_periksa = $request->get('jam_periksa');
            $skrining_tb->pertanyaan_satu = $request->get('gejala1');
            $skrining_tb->pertanyaan_dua = $request->get('gejala2');
            $skrining_tb->pertanyaan_tiga = $request->get('gejala3');
            $skrining_tb->pertanyaan_empat = $request->get('gejala4');
            $skrining_tb->pertanyaan_lima = $request->get('gejala5');
            $skrining_tb->pertanyaan_enam = $request->get('gejala6');
            $skrining_tb->pertanyaan_tujuh = $request->get('gejala7');
            $skrining_tb->pertanyaan_delapan = $request->get('gejala8');
            $skrining_tb->pertanyaan_sembilan = $request->get('gejala9');
            $skrining_tb->pertanyaan_sepuluh = $request->get('gejala10');
            $skrining_tb->update();

            DB::commit();
            return redirect()->route('skrining-pasien.show',$id)->withStatus('Berhasil mengganti data.');
        } catch (Exception $th) {
            DB::rollBack();
            return redirect()->route('skrining-pasien.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
