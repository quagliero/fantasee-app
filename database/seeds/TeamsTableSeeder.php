<?php

class TeamsTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('teams')->truncate();

        Team::create([
          'league_id' => 1,
          'manager_id' => 1,
          'name' => 'The Vineyard'
        ]);

        Team::create([
          'league_id' => 1,
          'manager_id' => 2,
          'name' => 'Gerald Siiiiiiiiibon'
        ]);

        Team::create([
          'league_id' => 1,
          'manager_id' => 3,
          'name' => 'Bush Johnson'
        ]);

        Team::create([
          'league_id' => 1,
          'manager_id' => 4,
          'name' => '21st and Hine'
        ]);

    }

}
