<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class LeagueSeasonWeekTableSeeder extends Seeder {

    public function run()
    {
      $data = [];
      $weeks = 16;
      $leagues = [1, 2];
      $seasons = [
        [1, 2, 3],
        [2, 3]
      ];

      for ($i = 0; $i < count($leagues); $i++)
      {
        for ($j = 0; $j < count($seasons[$i]); $j++)
        {
          for ($k = 1; $k <= $weeks; $k++)
          {
            $data[] = [
              'league_id' => $leagues[$i],
              'season_id' => $seasons[$i][$j],
              'week_id' => $k,
            ];
          }
        }
      }

      DB::table('league_season_week')->insert($data);
    }

}
