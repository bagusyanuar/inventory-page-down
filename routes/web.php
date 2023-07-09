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

Route::group(['middleware' => 'auth'], function (){
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'pengguna'], function () {
        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\PenggunaController::class, 'index'])->name('pengguna');
        Route::post('/{id}', [\App\Http\Controllers\Admin\PenggunaController::class, 'patch'])->name('pengguna.update');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\PenggunaController::class, 'destroy'])->name('pengguna.delete');
    });

    Route::group(['prefix' => 'supplier'], function () {
        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\SupplierController::class, 'index'])->name('supplier');
        Route::post('/{id}', [\App\Http\Controllers\Admin\SupplierController::class, 'patch'])->name('supplier.update');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\SupplierController::class, 'destroy'])->name('supplier.delete');
    });

    Route::group(['prefix' => 'jenis-barang'], function () {
        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\JenisBarangController::class, 'index'])->name('jenis-barang');
        Route::post('/{id}', [\App\Http\Controllers\Admin\JenisBarangController::class, 'patch'])->name('jenis-barang.update');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\JenisBarangController::class, 'destroy'])->name('jenis-barang.delete');
    });

    Route::group(['prefix' => 'bahan'], function () {
        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\BahanController::class, 'index'])->name('bahan');
        Route::post('/{id}', [\App\Http\Controllers\Admin\BahanController::class, 'patch'])->name('bahan.update');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\BahanController::class, 'destroy'])->name('bahan.delete');
    });

    Route::group(['prefix' => 'warna'], function () {
        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\WarnaController::class, 'index'])->name('warna');
        Route::post('/{id}', [\App\Http\Controllers\Admin\WarnaController::class, 'patch'])->name('warna.update');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\WarnaController::class, 'destroy'])->name('warna.delete');
    });

    Route::group(['prefix' => 'barang'], function () {
        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\BarangController::class, 'index'])->name('barang');
        Route::post('/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'patch'])->name('barang.update');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\BarangController::class, 'destroy'])->name('barang.delete');
    });

    Route::group(['prefix' => 'laporan-stok'], function () {
        Route::get( '/', [\App\Http\Controllers\Admin\LaporanStokController::class, 'index'])->name('laporan-stok');
        Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanStokController::class, 'cetak'])->name('laporan-stok.cetak');
    });

    Route::group(['prefix' => 'laporan-barang-masuk'], function () {
        Route::get( '/', [\App\Http\Controllers\Admin\LaporanBarangMasukController::class, 'index'])->name('laporan-barang-masuk');
        Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanBarangMasukController::class, 'cetak'])->name('laporan-barang-masuk.cetak');
    });

    Route::group(['prefix' => 'laporan-barang-keluar'], function () {
        Route::get( '/', [\App\Http\Controllers\Admin\LaporanBarangKeluarController::class, 'index'])->name('laporan-barang-keluar');
        Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanBarangKeluarController::class, 'cetak'])->name('laporan-barang-keluar.cetak');
    });
});

