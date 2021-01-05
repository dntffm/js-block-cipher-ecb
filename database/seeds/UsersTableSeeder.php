<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\art;
use App\master;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
            'role' => 1,
            'email' => 'adminku@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(60),
        ]);

       //  $art = factory(User::class,10)->create();
       //    foreach( $art as $user)
       //    {
       //      factory(art::class)->create([
       //      'user_id' => $user->id

       // ]);
     

       $users = factory(User::class,20)->create();
          foreach( $users as $user)
          {
            if ($user->role == 2){
            factory(master::class)->create([
            'user_id' => $user->id

       ]); }
          elseif($user->role == 3){
            factory(art::class)->create([
            'user_id' => $user->id
          ]);}
     }

}

}
