<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Art;
use Faker\Generator as Faker;

$factory->define(\App\art::class, function (Faker $faker) {

    return [
      
        'user_id' => $faker->numberBetween($min = 5, $max = 9000),
        // 'foto' =>$faker->image($dir = 'tmp', $width = 640, $height = 480),
        'name'=> $faker->name,
        'nohp'=>$faker->phoneNumber,
        'tanggallahir'=>$faker->dateTimeBetween($startDate = '-60 years', $endDate = '2001-03-15', $timezone = null),
        'kecamatan'=>$faker->citySuffix,
        'alamat'=>$faker->streetAddress ,
        'kodepos'=>$faker->postcode,
        'status'=>1,
        'deskripsi'=>$faker->realText($maxNbChars = 200, $indexSize = 2),
    ];
});
