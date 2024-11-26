<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\SkriningPasien;
use App\Models\SkriningPasienIGD;
use App\Models\SkriningPasienTB;
use Illuminate\Http\Request;

class LaporanSkriningPasienController extends Controller
{
    public function index(Request $request) {
        $query = SkriningPasien::with('pasien');
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [
                \Carbon\Carbon::createFromFormat('m/d/Y', $request->start_date)->startOfDay(),
                \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->startOfDay()
            ]);
        }
        $data = $query->latest()->get();
        return view('dashboard.laporan.skrining-pasien.index',compact('data'));
    }

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
        return view('dashboard.laporan.skrining-pasien.show',compact('pasien','skrining_tb','skrining_igd','skrining'));

    }
}
