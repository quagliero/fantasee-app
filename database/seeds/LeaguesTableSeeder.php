<?php

class LeaguesTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('leagues')->truncate();

        League::create([
          'user_id' => 1,
          'league_id' => 874089,
          'name' => 'The Chumbolone',
          'slug' => 'the-chumbo'
        ]);
    }

}
