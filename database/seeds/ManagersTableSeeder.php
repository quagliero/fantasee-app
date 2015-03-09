<?php

class ManagersTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('managers')->truncate();

        Manager::create([
          'name' => 'Tobias'
        ]);

        Manager::create([
          'name' => 'Andrew'
        ]);

        Manager::create([
          'name' => 'Dave'
        ]);

        Manager::create([
          'name' => 'Hine'
        ]);

    }

}
