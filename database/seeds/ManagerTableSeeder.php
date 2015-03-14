<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends DatabaseSeeder {

    public function run()
    {
        $managers = [
          [
            'name' => 'Tobias',
            'league_id' => 1
          ],
          [
            'name' => 'Andrew',
            'league_id' => 1
          ],
          [
            'name' => 'Dave',
            'league_id' => 1
          ],
          [
            'name' => 'Hine',
            'league_id' => 1
          ],
          [
            'name' => 'Foo',
            'league_id' => 2
          ],
          [
            'name' => 'Bar',
            'league_id' => 2
          ],
          [
            'name' => 'Baz',
            'league_id' => 2
          ],
          [
            'name' => 'Qux',
            'league_id' => 2
          ],
        ];

        DB::table('managers')->insert($managers);
    }

}
