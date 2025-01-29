<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\PasienCovid;
use App\Models\SkriningAwal;
use App\Models\SkriningLanjutan;
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
            $skrining_tb = SkriningPasienTB::where('pasien_id',$skrining->pasien_id)->where('status_skrining','skrining_pasien')->first();
        }

        $skrining_igd = null;
        if ($pasien->Kondisi->status_kondisi == 'Diarahkan ke IGD') {
            $skrining_igd = SkriningPasienIGD::where('pasien_id',$skrining->pasien_id)->where('status_skrining','skrining_pasien')->first();
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
            $skrining_tb = SkriningPasienTB::where('pasien_id',$skrining->pasien_id)->where('status_skrining','skrining_pasien')->first();
        }

        $skrining_igd = null;
        if ($pasien->Kondisi->status_kondisi == 'Diarahkan ke IGD') {
            $skrining_igd = SkriningPasienIGD::where('pasien_id',$skrining->pasien_id)->where('status_skrining','skrining_pasien')->first();
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
            $skrining_tb = SkriningPasienTB::where('pasien_id',$skrining->pasien_id)->where('status_skrining','skrining_pasien')->first();
        }

        $skrining_igd = null;
        if ($pasien->Kondisi->status_kondisi == 'Diarahkan ke IGD') {
            $skrining_igd = SkriningPasienIGD::where('pasien_id',$skrining->pasien_id)->where('status_skrining','skrining_pasien')->first();
        }
        return view('dashboard.laporan.skrining-pasien.pdf.cetak-igd',compact('pasien','skrining_tb','skrining_igd','skrining'));
    }

    public function cetakSkrinignPasienCovid($id) {
        $pasien = PasienCovid::with('user')->find($id);
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

        return view('dashboard.laporan.skrining-pasien-covid.pdf.covid',compact('pasien','skrining_awal','skrining_lanjutan','skrining_igd','skrining_tb'));

    }

    public function cetakSkrinignPasienCovidTB($id)  {
        $pasien = PasienCovid::with('user')->find($id);
        $skrining_awal = SkriningAwal::where('pasien_id',$pasien->id)->get();
        $skrining_lanjutan = SkriningLanjutan::where('pasien_id',$pasien->id)->get();
        $skrining_igd = null;
        if ($pasien->keterangan == 'Triase COVID (IGD)') {
            $skrining_igd = SkriningPasienIGD::where('pasien_id',$pasien->id)->where('status_skrining','skrining_pasien_covid')->first();
        }
        $skrining_tb = null;
        if ($pasien->keterangan == 'Klinik TB') {
            $skrining_tb = SkriningPasienTB::where('pasien_id',$pasien->id)->where('status_skrining','skrining_pasien_covid')->first();
        }
        return view('dashboard.laporan.skrining-pasien.pdf.cetak-tb',compact('pasien','skrining_tb','skrining_igd','skrining'));

    }

    public function cetakSkrinignPasienCovidIGD($id) {
        $pasien = PasienCovid::with('user')->find($id);
        $skrining_awal = SkriningAwal::where('pasien_id',$pasien->id)->get();
        $skrining_lanjutan = SkriningLanjutan::where('pasien_id',$pasien->id)->get();
        $skrining_igd = null;
        if ($pasien->keterangan == 'Triase COVID (IGD)') {
            $skrining_igd = SkriningPasienIGD::where('pasien_id',$pasien->id)->where('status_skrining','skrining_pasien_covid')->first();
        }
        $skrining_tb = null;
        if ($pasien->keterangan == 'Klinik TB') {
            $skrining_tb = SkriningPasienTB::where('pasien_id',$pasien->id)->where('status_skrining','skrining_pasien_covid')->first();
        }
        return view('dashboard.laporan.skrining-pasien.pdf.cetak-igd',compact('pasien','skrining_tb','skrining_igd','skrining'));
    }

}
