<?php

// BACKEND
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

// Lainnya
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Auth::routes();

// BACKEND ROUTE
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('training', TrainingController::class);
    Route::resource('sertifikat', SertifikatController::class);
    Route::get('/sertifikat/{id}/preview', [SertifikatController::class, 'printCertificate'])->name('sertifikat.preview')->defaults('isPreview', true);
    Route::get('/sertifikat/{id}/print', [SertifikatController::class, 'printCertificate'])->name('sertifikat.print');

    Route::get('/export-excel', [SertifikatController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export-pdf', [SertifikatController::class, 'exportPDF'])->name('export.pdf');

    Route::get('/export-training', [TrainingController::class, 'exportExcel'])->name('export.training');

    // USER
    Route::resource('users', UserController::class);
    Route::get('/users/{id}', [UserController::class, 'index']);
    Route::resource('roles', RoleController::class);
});

// FRONTEND ROUTE
Route::get('/pelatihan/{id}', [PelatihanController::class, 'pelatihan']);
Route::get('/more', [App\Http\Controllers\MoreController::class, 'index'])->name('more');
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/check-certificate', [WelcomeController::class, 'checkCertificate'])->name('checkCertificate');
Route::post('/check-certificate', [WelcomeController::class, 'checkCertificate'])->name('checkCertificate');
Route::get('/more', [App\Http\Controllers\MoreController::class, 'index'])->name('more');
Route::get('/pelatihan/{id}', [PelatihanController::class, 'pelatihan']);
