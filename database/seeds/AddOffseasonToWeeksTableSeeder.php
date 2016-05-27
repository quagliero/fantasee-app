<?php

use Illuminate\Database\Seeder;

class AddOffseasonToWeeksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('weeks')->insert([
        'name' => 'Offseason',
        ]);
    }
}
