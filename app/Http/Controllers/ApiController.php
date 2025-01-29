<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function pasien(Request $request){
        $query = $request->get('q');
        $data = Pasien::where('no_rm', 'like', "%$query%")->get(['no_rm']);
        return response()->json($data);
    }

    public function getPasien($no_rm)
    {
        $patient = Pasien::where('no_rm', $no_rm)->firstOrFail();
        return response()->json($patient);
    }

}
