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
        // $this->call(UsersTableSeeder::class);
       factory('App\User',200)->create();
      // factory('App\Batch',10)->create();
         //$this->call(AdminsTableSeeder::class);
    }
}
