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
          'slug' => 'the-chumbo'],
          ['user_id' => 2,
          'league_id' => 12345,
          'name' => 'The Others',
          'slug' => 'the-others']
        ];

        DB::table('leagues')->insert($leagues);
    }

}
