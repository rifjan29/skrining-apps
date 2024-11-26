<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\SkriningPasien;
use App\Models\SkriningPasienIGD;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkriningPasienIGDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pasien = Pasien::find($id);
        return view('dashboard.igd.create',compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal' => 'required',
            'tanggal' => 'required',
            'primary_survey_a' => 'required',
            'primary_survey_b' => 'required',
            'primary_survey_c' => 'required',
            'primary_survey_d' => 'required',
            'primary_survey_e' => 'required',
            'secondary_survey' => 'required',
            'td' => 'required',
            'nadi' => 'required',
            'frekuensi_pernapasan' => 'required',
            'suhu' => 'required',
            'saturasi_oksigen' => 'required',
            'riwayat_penyakit' => 'required',
            'klasifikasi_pasien' => 'required',
            'triage' => 'required',
            'pemeriksaan_penunjang' => 'required',
            'tindak_lanjut' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $pasien = Pasien::find($id);
            $pasien->tempat_lahir = $request->get('tempat_lahir');
            $pasien->jenis_kelamin = $request->get('jenis_kelamin');
            $pasien->update();
            // SKRINING PASIEN IGD
            $skriningIGD = new SkriningPasienIGD;
            $skriningIGD->pasien_id = $id;
            $skriningIGD->tanggal = Carbon::parse($request->get('tanggal'));
            $skriningIGD->jam = $request->get('jam');
            $skriningIGD->primary_survey_a = $request->get('primary_survey_a');
            $skriningIGD->primary_survey_b = $request->get('primary_survey_b');
            $skriningIGD->primary_survey_c = $request->get('primary_survey_c');
            $skriningIGD->primary_survey_d = $request->get('primary_survey_d');
            $skriningIGD->primary_survey_e = $request->get('primary_survey_e');
            $skriningIGD->secondary_survey = $request->get('secondary_survey');
            $skriningIGD->td = $request->get('td');
            $skriningIGD->nadi = $request->get('nadi');
            $skriningIGD->frekuensi_pernapasan = $request->get('frekuensi_pernapasan');
            $skriningIGD->suhu = $request->get('suhu');
            $skriningIGD->saturasi_oksigen = $request->get('saturasi_oksigen');
            $skriningIGD->riwayat_penyakit = $request->get('riwayat_penyakit');
            $skriningIGD->klasifikasi_pasien = $request->get('klasifikasi_pasien');
            $skriningIGD->triage = $request->get('triage');
            $skriningIGD->pemeriksaan_penunjang = json_encode($request->get('pemeriksaan_penunjang'));
            $skriningIGD->tindak_lanjut = json_encode($request->get('tindak_lanjut'));
            $skriningIGD->save();
            // UPDATE SKRINING PASIEN
            SkriningPasien::where('pasien_id',$id)->first()->update([
                'status_skrining' => "selesai"
            ]);


            DB::commit();
            return redirect()->route('skrining-pasien.index')->withStatus('Berhasil menambahkan data.');

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
