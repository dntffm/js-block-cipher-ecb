<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class bank extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        DB::table('bank')->insert([
            'bank' => 1,
            'no_rekening' => $faker->creditCardNumber,
            'nama' => 'CleaningART Team',
        ]);
        DB::table('bank')->insert([
            'bank' => 2,
            'no_rekening' => $faker->creditCardNumber,
            'nama' => 'CleaningART Team',
        ]);
         DB::table('bank')->insert([
            'bank' => 3,
            'no_rekening' => $faker->creditCardNumber,
            'nama' => 'CleaningART Team',
        ]);
    }
}
