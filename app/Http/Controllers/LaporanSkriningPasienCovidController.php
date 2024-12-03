<?php

namespace App\Http\Controllers;

use App\Models\PasienCovid;
use App\Models\SkriningAwal;
use App\Models\SkriningLanjutan;
use App\Models\SkriningPasienIGD;
use App\Models\SkriningPasienTB;
use Illuminate\Http\Request;

class LaporanSkriningPasienCovidController extends Controller
{
    public function index(Request $request) {
        $query = new PasienCovid;
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [
                \Carbon\Carbon::createFromFormat('m/d/Y', $request->start_date)->startOfDay(),
                \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->startOfDay()
            ]);
        }
        $data = $query->latest()->get();
        return view('dashboard.laporan.skrining-pasien-covid.index',compact('data'));
    }

    public function show($id) {
        $pasien = PasienCovid::find($id);
        $skrining_awal = SkriningAwal::where('pasien_id',$pasien->id)->get();
        $skrining_lanjutan = SkriningLanjutan::where('pasien_id',$pasien->id)->get();
        $skrining_igd = null;
        if ($pasien->keterangan == 'Triase COVID (IGD)') {
            $skrining_igd = SkriningPasienIGD::where('pasien_id',$pasien->id)->first();
        }
        $skrining_tb = null;
        if ($pasien->keterangan == 'Klinik TB') {
            $skrining_tb = SkriningPasienTB::where('pasien_id',$pasien->id)->first();
        }

        return view('dashboard.laporan.skrining-pasien-covid.show',compact('pasien','skrining_awal','skrining_lanjutan','skrining_igd','skrining_tb'));
    }


}
