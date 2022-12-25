<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PengumumanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [AuthController::class, 'login']);


Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function() {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('downloadimage', [AuthController::class, 'downloadImage']);
    Route::post('uploadimage', [AuthController::class, 'uploadImage']);
    Route::post('logoutall', [AuthController::class, 'logoutall']);
    Route::post('jadwal', [JadwalController::class, 'index']);
    Route::get('pengumuman', [PengumumanController::class,'index']);

    // Route::post('absen', [JadwalController::class, 'absen']);
});


