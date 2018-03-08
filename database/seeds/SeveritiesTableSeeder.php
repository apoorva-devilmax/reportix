<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeveritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('severities')->insert([
        	[
        		'level' => 'Critical',
        		'color_code' => '#006FC0',
        		'description' => 'The observation represents critical issue, and needs immediate action to address the issue.'
        	],
        	[
        		'level' => 'High',
        		'color_code' => '#FF0000',
        		'description' => 'The observation represents a significant weakness in the current control environment and requires management’s immediate consideration and action to meet minimum control standards.'
        	],
        	[
        		'level' => 'Medium',
        		'color_code' => '#FFC000',
        		'description' => 'The observation is an opportunity to improve the effectiveness of the control environment and requires management action in the near term.'
        	],
        	[
        		'level' => 'Low',
        		'color_code' => '#00AF50',
        		'description' => 'The observation is an opportunity to improve efficiency of the control processes.'
        	]
        ]);
    }
}
