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
            'name' => 'Apoorva Kumar',
            'email' => 'apoorva.kumar@nomail.com',
            'password' => 'apoorva@123$',
            'role' => 'admin'
        ]);
    }
}
