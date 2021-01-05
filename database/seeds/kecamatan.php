<?php

use Illuminate\Database\Seeder;

class kecamatan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	for ($i=1; $i < 26; $i++) { 
		 DB::table('kecamatan')->insert([
            'kecamatan' => $i,
        ]);
	}
    }
}
