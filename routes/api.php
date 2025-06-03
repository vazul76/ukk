<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\IndustriController;
use App\Http\Controllers\Api\PklController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/siswa', [SiswaController::class, 'index']);
Route::resource('/siswa', SiswaController::class);
Route::resource('/guru', GuruController::class);
Route::resource('/industri', IndustriController::class);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('pkl', PklController::class);
});

