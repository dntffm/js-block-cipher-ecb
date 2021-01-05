<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->binary('foto')->nullable();
            $table->string('name');
            $table->string('nohp');
            $table->string('kecamatan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kodepos')->nullable();
            $table->biginteger('user_id')->unsigned();

            //$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master');
    }
}
