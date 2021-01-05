<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaketPekerjaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_pekerjaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->binary('foto_paket')->nullable();
            $table->string('nama_paket')->unique();
            $table->string('deskripsi_paket');
            $table->biginteger('harga_paket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket_pekerjaan');
    }
}
