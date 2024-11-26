<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\SkriningPasien;
use App\Models\SkriningPasienTB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkriningPasienTBController extends Controller
{
    public function create(Request $request, $id) {
        $skrining = SkriningPasien::find($id);
        $pasien = Pasien::find($skrining->pasien_id);
        return view('dashboard.tb.create',compact('pasien'));
    }

    public function store(Request $request, $id) {
        $request->validate([
            'tempat_lahir' => 'required|string',
            'jenis_kelamin' => 'required|in:0,1', // Assuming '1' and '2' are valid gender options
            'tanggal_kedatangan' => 'required|date',
            'jam_datang' => 'required|date_format:H:i',
            'tanggal_periksa' => 'required|date',
            'jam_periksa' => 'required|date_format:H:i',
            'gejala1' => 'required|in:ya,tidak',
            'gejala2' => 'required|in:ya,tidak',
            'gejala3' => 'required|in:ya,tidak',
            'gejala4' => 'required|in:ya,tidak',
            'gejala5' => 'required|in:ya,tidak',
            'gejala6' => 'required|in:ya,tidak',
            'gejala7' => 'required|in:ya,tidak',
            'gejala8' => 'required|in:ya,tidak',
            'gejala9' => 'required|in:ya,tidak',
            'gejala10' => 'required|in:ya,tidak',
        ]);
        try {

            DB::beginTransaction();

            $pasien = Pasien::find($id);
            $pasien->tempat_lahir = $request->get('tempat_lahir');
            $pasien->jenis_kelamin = $request->get('jenis_kelamin');
            $pasien->update();

            // skrining tb
            $skrining_tb = new SkriningPasienTB;
            $skrining_tb->pasien_id = $id;
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
            $skrining_tb->save();

            SkriningPasien::where('pasien_id',$id)->first()->update([
                'status_skrining' => "selesai"
            ]);
            DB::commit();
            return redirect()->route('skrining-pasien.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $th) {
            return $th;
            DB::rollBack();
            return redirect()->route('skrining-pasien.index')->withError('Terjadi kesalahan.');
        }
    }
}
