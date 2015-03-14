<?php

use Illuminate\Database\Seeder;

class LeagueSeasonTeamTableSeeder extends Seeder {

    public function run()
    {
      $data = [];

      for($i = 1; $i < 4; $i++) {
        $data[] = [
          'league_id' => 1,
          'season_id' => 1,
          'team_id' => $i
        ];
      }

      for($i = 1; $i < 5; $i++) {
        $data[] = [
          'league_id' => 1,
          'season_id' => 2,
          'team_id' => $i
        ];
      }

      for($i = 1; $i < 5; $i++) {
        $data[] = [
          'league_id' => 1,
          'season_id' => 3,
          'team_id' => $i
        ];
      }

      for($i = 5; $i < 9; $i++) {
        $data[] = [
          'league_id' => 2,
          'season_id' => 2,
          'team_id' => $i
        ];
      }

      for($i = 5; $i < 7; $i++) {
        $data[] = [
          'league_id' => 2,
          'season_id' => 3,
          'team_id' => $i
        ];
      }

      DB::table('league_season_team')->insert($data);
    }

}
