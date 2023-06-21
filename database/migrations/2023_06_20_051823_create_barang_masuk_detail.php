<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasukDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuk_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barang_masuk_id')->unsigned()->nullable();
            $table->bigInteger('jenis_barang_id')->unsigned();
            $table->bigInteger('warna_id')->unsigned();
            $table->string('ukuran');
            $table->integer('qty');
            $table->timestamps();
            $table->foreign('barang_masuk_id')->references('id')->on('barang_masuk');
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
        Schema::dropIfExists('barang_masuk_detail');
    }
}
