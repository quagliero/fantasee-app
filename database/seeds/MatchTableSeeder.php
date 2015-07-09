<?php

use Illuminate\Database\Seeder;

class MatchTableSeeder extends Seeder {

    public function run()
    {
      $matches = [];
      $leagues = [1];
      $seasons = [1, 2, 3];
      $weeks = [14, 14, 13];
      $team_id = [
        // season 2012
        [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        // season 2013
        [11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
        // season 2014
        [21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32],
      ];

      for ($i=0; $i < count($leagues); $i++)
      {
        for($j=0; $j < count($seasons); $j++)
        {
          for ($k=1; $k <= $weeks[$j]; $k++)
          {
            $teams = $team_id[$j];
            $played = [];

            for ($l=0; $l < count($team_id[$j]); $l++)
            {
              $team1 = $team_id[$j][$l];

              if (in_array($team1, $played)) {
                continue;
              }

              if (($key1 = array_search($team1, $teams)) !== false) {
                  unset($teams[$key1]);
              }

              unset($teams[$key1]);
              $teams = array_values($teams);
              $max = count($teams) - 1;
              $rand = mt_rand(0, $max);
              $team2 = $teams[$rand];

              if (($key2 = array_search($team2, $teams)) !== false) {
                  unset($teams[$key2]);
              }

              $matches[] = [
                'league_id' => $leagues[$i],
                'season_id' => $seasons[$j],
                'week_id' => $k,
                'team1_id' => $team1,
                'team2_id' => $team2,
                'team1_score' => mt_rand(60, 150),
                'team2_score' => mt_rand(60, 150),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
              ];

              $played[] = $team1;
              $played[] = $team2;
            }
          }
        }
      }

      DB::table('matches')->insert($matches);
    }
}
