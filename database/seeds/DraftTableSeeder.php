<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class DraftTableSeeder extends Seeder {

    public function generateRandom() {
      return rand(100, 500);
    }

    public function run()
    {
      $drafts = [];
      $leagues = [1];
      $seasons = [1, 2, 3];
      $rounds = [15, 15, 15];
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
          for ($k=1; $k <= $rounds[$j]; $k++)
          {
            $drafted = [];

            for ($l=0; $l < count($team_id[$j]); $l++)
            {

              $team = $team_id[$j][$l];
              $pick = ($l + 1);
              if ($k > 1) {
                $pick += ($k - 1) * count($team_id[$j]);
              }
              $player = $this->generateRandom();

              while (in_array($player, $drafted)) {
                $player = $this->generateRandom();
              }

              $drafts[] = [
                'league_id' => $leagues[$i],
                'season_id' => $seasons[$j],
                'round_id' => $k,
                'pick' => $pick,
                'team_id' => $team,
                'player_id' => $player,
              ];
            }
          }
        }
      }

      DB::table('drafts')->insert($drafts);
    }

}
