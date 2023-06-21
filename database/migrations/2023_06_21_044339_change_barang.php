<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->bigInteger('bahan_id')->unsigned()->after('jenis_barang_id');
            $table->foreign('bahan_id')->references('id')->on('bahan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->string('nama')->after('warna_id');
            $table->dropForeign('barang_bahan_id_foreign');
            $table->dropColumn('bahan_id');
        });
    }
}
