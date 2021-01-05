<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\paket_pekerjaan;
use Faker\Generator as Faker;

$factory->define(paket_pekerjaan::class, function (Faker $faker) {
    return [
        'nama_paket' => 'PAKET ART',
        'harga_paket' => $faker->numberBetween($min = 50000, $max = 900000),
        'deskripsi_paket' => $faker->realText($maxNbChars = 200, $indexSize = 2), 
    ];
});
