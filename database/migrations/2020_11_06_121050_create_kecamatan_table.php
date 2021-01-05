<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('kecamatan',['Kencong',
'Gumukmas',
'Puger',
'Wuluhan',
'Ambulu',
'Tempurejo',
'Jenggawah',
'Ajung',
'Rambipuji',
'Balung',
'Semboro',
'Sumberbaru',
'Tanggul',
'Bangsalsari',
'Panti',
'Sukorambi',
'Arjasa',
'Pakusari',
'Kalisat',
'Ledokombo',
'Sumberjambe',
'Sukowono',
'Jelbuk',
'Kaliwates',
'Sumbersari',
'Patrang',
]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kecamatan');
    }
}
