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
          ['league_id' => 2,
          'manager_id' => 5,
          'name' => 'Bob Loblaw'],
          ['league_id' => 2,
          'manager_id' => 6,
          'name' => 'Test Tester'],
          ['league_id' => 2,
          'manager_id' => 7,
          'name' => 'Other Other'],
          ['league_id' => 2,
          'manager_id' => 8,
          'name' => 'Hillbilly'],
        ];

        DB::table('teams')->insert($teams);
    }

}
