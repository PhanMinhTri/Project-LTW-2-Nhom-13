<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('admins')->insert([
            'name' => 'administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'phone' => '01649573828',
            'avata' => 'avata.png',
            'level' => 100,
            'address' => 'Buôn Ma Thột',
            'status' => 1
        ]);
    }
}
