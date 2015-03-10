<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LeagueTableSeeder extends Seeder {

    public function run()
    {
        $leagues = [
          ['user_id' => 1,
          'league_id' => 874089,
          'name' => 'The Chumbolone',
          'slug' => 'the-chumbo']
        ];

        DB::table('leagues')->insert($leagues);
    }

}
