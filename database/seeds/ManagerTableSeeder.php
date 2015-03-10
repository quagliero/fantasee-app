<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends DatabaseSeeder {

    public function run()
    {
        $managers = [
          ['name' => 'Tobias'],
          ['name' => 'Andrew'],
          ['name' => 'Dave'],
          ['name' => 'Hine'],
        ];

        DB::table('managers')->insert($managers);
    }

}
