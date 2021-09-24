<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for admin demo
        DB::table('admins')->insert([
            'name'=>'Md.Admin',
            'email'=>'admin@blog.com',
            'password'=>bcrypt('rootAdmin'),
            ]);
    }
}
