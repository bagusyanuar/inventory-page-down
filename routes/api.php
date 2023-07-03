<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::match(['post', 'get'], '/supplier', [\App\Http\Controllers\API\SupplierController::class, 'index']);
    Route::match(['post', 'get'], '/jenis-barang', [\App\Http\Controllers\API\JenisBarangController::class, 'index']);
    Route::match(['post', 'get'], '/bahan', [\App\Http\Controllers\API\BahanController::class, 'index']);
    Route::match(['post', 'get'], '/warna', [\App\Http\Controllers\API\WarnaController::class, 'index']);
    Route::match(['post', 'get'], '/barang', [\App\Http\Controllers\API\BarangController::class, 'index']);

    Route::group(['prefix' => 'barang-masuk'], function () {
        Route::match(['post', 'get'], '/', [\App\Http\Controllers\API\BarangMasukController::class, 'index']);
        Route::get('/{id}/detail', [\App\Http\Controllers\API\BarangMasukController::class, 'detail']);
        Route::match(['post', 'get'], '/cart', [\App\Http\Controllers\API\BarangMasukController::class, 'cart']);
    });

    Route::group(['prefix' => 'barang-keluar'], function () {
        Route::match(['post', 'get'], '/', [\App\Http\Controllers\API\BarangKeluarController::class, 'index']);
        Route::get('/{id}/detail', [\App\Http\Controllers\API\BarangKeluarController::class, 'detail']);
        Route::match(['post', 'get'], '/cart', [\App\Http\Controllers\API\BarangKeluarController::class, 'cart']);
    });

});
