<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(pajak::class);
         $this->call(data_pekerjaan::class);
         $this->call(bank::class);
        $this->call(status_penerimaan::class);
        $this->call(statuspembayaran::class);
        $this->call(kecamatan::class);
    }
}
