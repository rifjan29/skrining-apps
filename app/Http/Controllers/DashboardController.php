<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\PasienCovid;
use App\Models\SkriningPasien;
use App\Models\SkriningPasienIGD;
use App\Models\SkriningPasienTB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $year = $request->get('year');
        $date = $request->get('date');

        // Filter data
        $skrining_pasien = SkriningPasien::when($year, function ($query, $year) {
            $query->whereYear('created_at', $year);
        })->when($date, function ($query, $date) {
            $query->whereDate('created_at', $date);
        })->count();

        $skrinig_covid = PasienCovid::when($year, function ($query, $year) {
            $query->whereYear('created_at', $year);
        })->when($date, function ($query, $date) {
            $query->whereDate('created_at', $date);
        })->count();

        $skrining_pasien_data = SkriningPasien::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->when($year, function ($query, $year) {
                $query->whereYear('created_at', $year);
            })
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $skrinig_covid_data = PasienCovid::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->when($year, function ($query, $year) {
                $query->whereYear('created_at', $year);
            })
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
        $skrining_igd = SkriningPasienIGD::count();
        $skrining_tb = SkriningPasienTB::count();
        $skrining_pasien_chart_data = array_replace(array_fill(1, 12, 0), $skrining_pasien_data);
        $skrinig_covid_chart_data = array_replace(array_fill(1, 12, 0), $skrinig_covid_data);
        $jumlah_pasien_kelamin = Pasien::select('jenis_kelamin', DB::raw('count(*) as jumlah'))
                            ->groupBy('jenis_kelamin')
                            ->get();
        if ($request->ajax()) {
            return response()->json([
                'skrining_pasien' => $skrining_pasien,
                'skrinig_covid' => $skrinig_covid,
                'skrining_pasien_data' => $skrining_pasien_chart_data,
                'skrinig_covid_data' => $skrinig_covid_chart_data
            ]);
        }

        return view('dashboard', compact(
                            'skrining_pasien',
                            'skrinig_covid',
                            'skrining_igd',
                            'skrining_tb',
                            'skrining_pasien_chart_data',
                            'skrinig_covid_chart_data',
                            'jumlah_pasien_kelamin'));
    }

    public function pdf(Request $request) {
        $year = $request->get('year');
        $date = $request->get('date');

        // Filter data
        $skrining_pasien = SkriningPasien::when($year, function ($query, $year) {
            $query->whereYear('created_at', $year);
        })->when($date, function ($query, $date) {
            $query->whereDate('created_at', $date);
        })->count();

        $skrinig_covid = PasienCovid::when($year, function ($query, $year) {
            $query->whereYear('created_at', $year);
        })->when($date, function ($query, $date) {
            $query->whereDate('created_at', $date);
        })->count();

        $skrining_pasien_data = SkriningPasien::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->when($year, function ($query, $year) {
                $query->whereYear('created_at', $year);
            })
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $skrinig_covid_data = PasienCovid::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->when($year, function ($query, $year) {
                $query->whereYear('created_at', $year);
            })
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
        $skrining_igd = SkriningPasienIGD::count();
        $skrining_tb = SkriningPasienTB::count();
        $skrining_pasien_chart_data = array_replace(array_fill(1, 12, 0), $skrining_pasien_data);
        $skrinig_covid_chart_data = array_replace(array_fill(1, 12, 0), $skrinig_covid_data);
        $jumlah_pasien_kelamin = Pasien::select('jenis_kelamin', DB::raw('count(*) as jumlah'))
                            ->groupBy('jenis_kelamin')
                            ->get();
        if ($request->ajax()) {
            return response()->json([
                'skrining_pasien' => $skrining_pasien,
                'skrinig_covid' => $skrinig_covid,
                'skrining_pasien_data' => $skrining_pasien_chart_data,
                'skrinig_covid_data' => $skrinig_covid_chart_data
            ]);
        }

        return view('pdf', compact(
                            'skrining_pasien',
                            'skrinig_covid',
                            'skrining_igd',
                            'skrining_tb',
                            'skrining_pasien_chart_data',
                            'skrinig_covid_chart_data',
                            'jumlah_pasien_kelamin'));
    }
}
