<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddDeletedAtToPembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  Schema::table('pembayaran', function (Blueprint $table) {
        //      $table->dropSoftDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::table('pembayaran', function (Blueprint $table) {
       //       $table->dropSoftDeletes();
       //  });
    }
}
