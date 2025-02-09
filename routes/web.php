<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanSkriningPasienController;
use App\Http\Controllers\LaporanSkriningPasienCovidController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkriningPasienController;
use App\Http\Controllers\SkriningPasienCovidController;
use App\Http\Controllers\SkriningPasienIGDController;
use App\Http\Controllers\SkriningPasienTBController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// pasien api
Route::get('pasien',[ApiController::class,'pasien'])->name('api-pasien.index');
Route::get('search-pasien/{no_rm}',[ApiController::class,'getPasien'])->name('api-pasien.search');
// export data
Route::get('export-chart',[DashboardController::class,'pdf'])->name('dashboard.pdf');
// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/',[DashboardController::class,'index'])->name('dashboard');
        // user
        Route::resource('user', UserController::class);
        // Skrining pasien
        Route::resource('skrining-pasien',SkriningPasienController::class);
        // Skrining Pasien IGD
        Route::post('skrining-pasien-igd/update-covid/{id}',[SkriningPasienIGDController::class,'updateCovid'])->name('skrining-pasien-igd.update-covid');
        Route::resource('skrining-pasien-igd',SkriningPasienIGDController::class);
        // Skrining Pasien TB
        Route::get('skrining-pasien-tb/create/{id}',[SkriningPasienTBController::class,'create'])->name('skrining-tb.create');
        Route::post('skrining-pasien-tb/create/store{id}',[SkriningPasienTBController::class,'store'])->name('skrining-tb.store');
        Route::post('skrining-pasien-tb/create-covid/store{id}',[SkriningPasienTBController::class,'storeCovid'])->name('skrining-tb.store-covid');
        // LAPORAN
        Route::get('laporan-skrining-pasien',[LaporanSkriningPasienController::class,'index'])->name('laporan.skrining-pasien');
        Route::get('laporan-skrining-pasien/show/{id}',[LaporanSkriningPasienController::class,'show'])->name('laporan.skrining-pasien.show');
        // LAPORAN PASIEN COVID
        Route::get('laporan-skrining-covid',[LaporanSkriningPasienCovidController::class,'index'])->name('laporan.skrining-covid');
        Route::get('laporan-skrining-covid/show/{id}',[LaporanSkriningPasienCovidController::class,'show'])->name('laporan.skrining-covid.show');
        // GENERATE CETAK PDF
        Route::get('cetak-skrining-pasien/{id}',[CetakController::class,'cetakSkrinignPasien'])->name('cetak.skrining-pasien');
        Route::get('cetak-skrining-pasien-igd/{id}',[CetakController::class,'cetakSkrinignPasienIGD'])->name('cetak.skrining-pasien.igd');
        Route::get('cetak-skrining-pasien-tb/{id}',[CetakController::class,'cetakSkrinignPasienTB'])->name('cetak.skrining-pasien.tb');
        // GENERATE CETAK PDF COVID
        Route::get('cetak-skrining-pasien-covid/{id}',[CetakController::class,'cetakSkrinignPasienCovid'])->name('cetak.skrining-pasien-covid');
        Route::get('cetak-skrining-pasien-covid-igd/{id}',[CetakController::class,'cetakSkrinignPasienCovidIGD'])->name('cetak.skrining-pasien-covid.igd');
        Route::get('cetak-skrining-pasien-covid-tb/{id}',[CetakController::class,'cetakSkrinignPasienCovidTB'])->name('cetak.skrining-pasien-covid.tb');
        // SKRINING PASIEN COVID
        Route::get('skrining-pasien-covid',[SkriningPasienCovidController::class,'index'])->name('skrining-covid.index');
        Route::get('skrining-pasien-covid/create',[SkriningPasienCovidController::class,'create'])->name('skrining-covid.create');
        Route::post('skrining-pasien-covid/store',[SkriningPasienCovidController::class,'store'])->name('skrining-covid.store');
        Route::get('skrining-pasien-covid/show/{id}',[SkriningPasienCovidController::class,'show'])->name('skrining-covid.show');
        Route::put('skrining-pasien-covid/update/{id}',[SkriningPasienCovidController::class,'update'])->name('skrining-covid.update');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
