<?php

use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanSkriningPasienController;
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
Route::prefix('dashboard')->group(function () {
    Route::middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/',[DashboardController::class,'index'])->name('dashboard');
        // user
        Route::resource('user', UserController::class);
        // Skrining pasien
        Route::resource('skrining-pasien',SkriningPasienController::class);
        // Skrining Pasien IGD
        Route::resource('skrining-pasien-igd',SkriningPasienIGDController::class);
        // Skrining Pasien TB
        Route::get('skrining-pasien-tb/create/{id}',[SkriningPasienTBController::class,'create'])->name('skrining-tb.create');
        Route::post('skrining-pasien-tb/create/store{id}',[SkriningPasienTBController::class,'store'])->name('skrining-tb.store');
        // LAPORAN
        Route::get('laporan-skrining-pasien',[LaporanSkriningPasienController::class,'index'])->name('laporan.skrining-pasien');
        Route::get('laporan-skrining-pasien/show/{id}',[LaporanSkriningPasienController::class,'show'])->name('laporan.skrining-pasien.show');
        // GENERATE CETAK PDF
        Route::get('cetak-skrining-pasien/{id}',[CetakController::class,'cetakSkrinignPasien'])->name('cetak.skrining-pasien');
        Route::get('cetak-skrining-pasien-igd/{id}',[CetakController::class,'cetakSkrinignPasienIGD'])->name('cetak.skrining-pasien.igd');
        Route::get('cetak-skrining-pasien-tb/{id}',[CetakController::class,'cetakSkrinignPasienTB'])->name('cetak.skrining-pasien.tb');
        // SKRINING PASIEN COVID
        Route::get('skrining-pasien-covid',[SkriningPasienCovidController::class,'index'])->name('skrining-covid.index');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
