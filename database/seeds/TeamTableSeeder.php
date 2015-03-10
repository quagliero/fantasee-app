<?php

use Illuminate\Database\Seeder;

class TeamTableSeeder extends DatabaseSeeder {

    public function run()
    {
        $teams = [
          ['league_id' => 1,
          'manager_id' => 1,
          'name' => 'The Vineyard'],
          ['league_id' => 1,
          'manager_id' => 2,
          'name' => 'Gerald Siiiiiiiiibon'],
          ['league_id' => 1,
          'manager_id' => 3,
          'name' => 'Bush Johnson'],
          ['league_id' => 1,
          'manager_id' => 4,
          'name' => '21st and Hine'],
        ];

        DB::table('teams')->insert($teams);
    }

}
