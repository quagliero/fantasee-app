<?php

use Illuminate\Database\Seeder;

class SeasonTableSeeder extends Seeder {

    public function run()
    {
        $seasons = [
          ['year' => 2010],
          ['year' => 2011],
          ['year' => 2012],
          ['year' => 2013],
          ['year' => 2014],
          ['year' => 2015],
        ];

        DB::table('seasons')->insert($seasons);
    }

}
