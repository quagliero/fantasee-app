<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends DatabaseSeeder {

    public function run()
    {
        $managers = [
          [
            'name' => 'Jimmie',
            'league_id' => 1
          ],
          [
            'name' => 'Dan',
            'league_id' => 1
          ],
          [
            'name' => 'Karsten',
            'league_id' => 1
          ],
          [
            'name' => 'Tobias',
            'league_id' => 1
          ],
          [
            'name' => 'Jason',
            'league_id' => 1
          ],
          [
            'name' => 'Dave',
            'league_id' => 1
          ],
          [
            'name' => 'Fintan',
            'league_id' => 1
          ],
          [
            'name' => 'Andrew',
            'league_id' => 1
          ],
          [
            'name' => 'Anthony',
            'league_id' => 1
          ],
          [
            'name' => 'Rich',
            'league_id' => 1
          ],
          [
            'name' => 'Dave',
            'league_id' => 1
          ],
          [
            'name' => 'Euan',
            'league_id' => 1
          ],
          [
            'name' => 'Chris',
            'league_id' => 1
          ],
          [
            'name' => 'Sol',
            'league_id' => 1
          ],
        ];

        DB::table('managers')->insert($managers);
    }

}
