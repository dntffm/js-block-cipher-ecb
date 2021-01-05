<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderArtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_art', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->biginteger('id_art')->unsigned();
            $table->biginteger('id_master')->unsigned();
            $table->biginteger('id_paket')->unsigned();
             $table->biginteger('id_bank')->unsigned();
             
            $table->biginteger('id_status_penerimaan')->unsigned();
            $table->string('nomor_order')->unique();
            $table->datetime('waktu_kerja');
            $table->enum('mp',['Belum Bayar', 'Bayar','Selesai', 'Batal', 'Tereview']);
            $table->string('total');
             // $table->time('time_up');
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_art');
    }
}
