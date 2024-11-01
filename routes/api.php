<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));

//posts
Route::apiResource('/training', App\Http\Controllers\Api\TrainingController::class);
Route::apiResource('/sertifikat', App\Http\Controllers\Api\SertifikatController::class);
Route::apiResource('/user', App\Http\Controllers\Api\UserController::class);
