<?php

use Illuminate\Database\Seeder;

class SeasonTableSeeder extends Seeder {

    public function run()
    {
        $seasons = [
          ['year' => 2008],
          ['year' => 2009],
          ['year' => 2010],
          ['year' => 2011],
          ['year' => 2012],
          ['year' => 2013],
          ['year' => 2014],
          ['year' => 2015],
        ];

        foreach ($seasons as &$s) {
          $s['created_at'] = date('Y-m-d H:i:s');
          $s['updated_at'] = date('Y-m-d H:i:s');
        }

        DB::table('seasons')->insert($seasons);
    }

}
