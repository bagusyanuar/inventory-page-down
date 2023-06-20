<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['post', 'get'],'/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logount', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'jenis-barang'], function () {
    Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\JenisBarangController::class, 'index'])->name('jenis-barang');
    Route::post('/{id}', [\App\Http\Controllers\Admin\JenisBarangController::class, 'patch'])->name('jenis-barang.update');
    Route::post('/{id}/delete', [\App\Http\Controllers\Admin\JenisBarangController::class, 'destroy'])->name('jenis-barang.delete');
});

Route::group(['prefix' => 'warna'], function () {
    Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\WarnaController::class, 'index'])->name('warna');
    Route::post('/{id}', [\App\Http\Controllers\Admin\WarnaController::class, 'patch'])->name('warna.update');
    Route::post('/{id}/delete', [\App\Http\Controllers\Admin\WarnaController::class, 'destroy'])->name('warna.delete');
});
