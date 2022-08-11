<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MapelController as mapel;

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

Route::post('login', ['as'=>'login',AuthController::class, 'login']);
Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function() {
    // manggil controller sesuai bawaan laravel 8
    Route::post('logout', [AuthController::class, 'logout']);
    // manggil controller dengan mengubah namespace di RouteServiceProvider.php biar bisa kayak versi2 sebelumnya
    Route::post('logoutall', [AuthController::class, 'logoutall']);
    Route::get('mapel/{nis}', [mapel::class, 'index']);
});
