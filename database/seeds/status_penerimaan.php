<?php

use Illuminate\Database\Seeder;

class status_penerimaan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_penerimaan')->insert([
            'status_penerimaan' => 1,
        ]);
        DB::table('status_penerimaan')->insert([
            'status_penerimaan' => 2,
        ]);
        DB::table('status_penerimaan')->insert([
            'status_penerimaan' => 3,
        ]);
    }
}
