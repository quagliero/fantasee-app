<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class LeagueSeasonTableSeeder extends Seeder {

    public function run()
    {

      $data = [
        [
          'league_id' => 1,
          'season_id' => 1
        ],
        [
          'league_id' => 1,
          'season_id' => 2
        ],
        [
          'league_id' => 1,
          'season_id' => 3
        ],
        [
          'league_id' => 2,
          'season_id' => 2
        ],
        [
          'league_id' => 2,
          'season_id' => 3
        ],
      ];
      DB::table('league_season')->insert($data);
    }

}
