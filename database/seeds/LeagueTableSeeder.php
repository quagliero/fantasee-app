<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LeagueTableSeeder extends Seeder {

    public function run()
    {
        $leagues = [
          ['user_id' => 1,
          'league_id' => 874089,
          'name' => 'The Chumbolone',
          'slug' => 'the-chumbo'],
          ['user_id' => 2,
          'league_id' => 12345,
          'name' => 'The Others',
          'slug' => 'the-others']
        ];

        factory(\Fantasee\League::class, 4)->create();

        foreach ($leagues as &$s) {
          $s['created_at'] = date('Y-m-d H:i:s');
          $s['updated_at'] = date('Y-m-d H:i:s');
        }

        DB::table('leagues')->insert($leagues);
    }

}
