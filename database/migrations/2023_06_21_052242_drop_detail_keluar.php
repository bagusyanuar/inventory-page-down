<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDetailKeluar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_keluar_detail', function (Blueprint $table) {
            $table->dropForeign('barang_keluar_detail_jenis_barang_id_foreign');
            $table->dropForeign('barang_keluar_detail_warna_id_foreign');
            $table->dropColumn('jenis_barang_id');
            $table->dropColumn('warna_id');
            $table->dropColumn('ukuran');
            $table->bigInteger('barang_id')->unsigned()->after('barang_keluar_id');
            $table->foreign('barang_id')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_keluar_detail', function (Blueprint $table) {
            $table->bigInteger('jenis_barang_id')->unsigned();
            $table->bigInteger('warna_id')->unsigned();
            $table->string('ukuran');
            $table->foreign('jenis_barang_id')->references('id')->on('jenis_barang');
            $table->foreign('warna_id')->references('id')->on('warna');
            $table->dropForeign('barang_keluar_detail_barang_id_foreign');
            $table->dropColumn('barang_id');
        });
    }
}
