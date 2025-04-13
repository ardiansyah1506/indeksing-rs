<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ICD10PrimaryController;
use App\Http\Controllers\ICD10SecondaryController;
use App\Http\Controllers\ICD9Controller;
use App\Http\Controllers\IndeksDokterController;
use App\Http\Controllers\IndeksingController;
use App\Http\Controllers\IndeksKematianController;
use App\Http\Controllers\IndeksPenyakitController;
use App\Http\Controllers\IndeksTindakanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register.index');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('indeksing', IndeksingController::class);
    Route::resource('indeksing-dokter', IndeksDokterController::class);
    Route::resource('indeksing-kematian', IndeksKematianController::class);
    Route::resource('indeksing-tindakan', IndeksTindakanController::class);
    Route::resource('penyakit', IndeksPenyakitController::class);
    Route::get('/pdf', [IndeksTindakanController::class, 'printPdf'])->name('pdf');
    Route::get('/viewPdf', [IndeksKematianController::class, 'viewPdf'])->name('pdf');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('icd10_primary', ICD10PrimaryController::class);
    Route::resource('icd10_secondary', ICD10SecondaryController::class);
    Route::resource('icd9', ICD9Controller::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('poli', PoliController::class);
    
});
