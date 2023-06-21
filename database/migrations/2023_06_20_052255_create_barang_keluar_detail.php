<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluarDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluar_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barang_keluar_id')->unsigned()->nullable();
            $table->bigInteger('jenis_barang_id')->unsigned();
            $table->bigInteger('warna_id')->unsigned();
            $table->string('ukuran');
            $table->integer('qty')->default(0);
            $table->timestamps();
            $table->foreign('barang_keluar_id')->references('id')->on('barang_keluar');
            $table->foreign('jenis_barang_id')->references('id')->on('jenis_barang');
            $table->foreign('warna_id')->references('id')->on('warna');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_keluar_detail');
    }
}
