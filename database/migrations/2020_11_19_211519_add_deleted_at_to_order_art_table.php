<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtToOrderArtTable extends Migration
{
    public function up()
    {
        Schema::table('order_art', function (Blueprint $table) {
             $table->softDeletes();
            
        });
    }

   
    public function down()
    {
        Schema::table('order_art', function (Blueprint $table) {
             $table->dropSoftDeletes();
        });
        
    }
}
