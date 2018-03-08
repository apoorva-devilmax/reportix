<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
            'name' => 'Nikhil Kumar',
            'email' => 'nikhil.kumar@biz2credit.com',
            'password' => 'nikhil@123$',
            'role' => 'admin'
        ]);
    }
}
