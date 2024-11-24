<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkriningPasienController;
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

    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
