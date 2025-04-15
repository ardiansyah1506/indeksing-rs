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
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register.index');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    
    Route::resource('indeksing', IndeksingController::class);
    Route::resource('indeksing-dokter', IndeksDokterController::class)->only(['index']);
    Route::resource('indeksing-kematian', IndeksKematianController::class)->only(['index']);
    Route::resource('indeksing-tindakan', IndeksTindakanController::class)->only(['index']);
    Route::resource('penyakit', IndeksPenyakitController::class)->only(['index']);
    Route::get('/indeksing-tindakan/pdf', [IndeksTindakanController::class, 'printPdf']);
    Route::get('/indeksing-penyakit/pdf', [IndeksPenyakitController::class, 'printPdf']);
    Route::get('/dokter/pdf', [IndeksDokterController::class, 'printPdf']);
    Route::get('/indeksing-dokter/pdf', [IndeksDokterController::class, 'printPdf']);
    Route::get('/indeksing-kematian/pdf', [IndeksKematianController::class, 'printPdf']);
    Route::get('/viewPdf', [IndeksKematianController::class, 'viewPdf'])->name('pdf');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('icd10_primary', ICD10PrimaryController::class);
    Route::resource('icd10_secondary', ICD10SecondaryController::class);
    Route::resource('icd9', ICD9Controller::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('poli', PoliController::class);
    
});
