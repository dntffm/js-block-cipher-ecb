<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\master;
use Faker\generator as Faker;

$factory->define(master::class, function (Faker $faker) {
    return [
      'name'=> $faker->name,
      'nohp'=>$faker->phoneNumber,
      'kecamatan'=>$faker->citySuffix,
      'alamat'=>$faker->streetAddress ,
      'kodepos'=>$faker->postcode, 
    ];
});
