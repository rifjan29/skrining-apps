<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\SkriningPasien;
use App\Models\SkriningPasienIGD;
use App\Models\SkriningPasienTB;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function cetakSkrinignPasien($id) {
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
        return view('dashboard.laporan.skrining-pasien.pdf.cetak-pasien',compact('pasien','skrining_tb','skrining_igd','skrining'));
    }

    public function cetakSkrinignPasienTB($id)  {
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
        return view('dashboard.laporan.skrining-pasien.pdf.cetak-tb',compact('pasien','skrining_tb','skrining_igd','skrining'));

    }

    public function cetakSkrinignPasienIGD($id) {
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
        return view('dashboard.laporan.skrining-pasien.pdf.cetak-igd',compact('pasien','skrining_tb','skrining_igd','skrining'));
    }
}
