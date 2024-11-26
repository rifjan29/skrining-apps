<?php

namespace App\Http\Controllers;

use App\Models\SkriningPasien;
use App\Models\SkriningPasienIGD;
use App\Models\SkriningPasienTB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $skrining_pasien = SkriningPasien::count();
        $skrining_igd = SkriningPasienIGD::count();
        $skrining_tb = SkriningPasienTB::count();
        return view('dashboard',compact('skrining_pasien','skrining_igd','skrining_tb'));
    }
}
