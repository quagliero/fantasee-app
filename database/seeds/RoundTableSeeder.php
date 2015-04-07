<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class RoundTableSeeder extends Seeder {

  public function run()
  {
    $maxRounds = 15;
    $rounds = [];

    for($i = 1; $i <= $maxRounds; $i++) {
      $rounds[] = [
        'name' => 'Round ' . $i
      ];
    }

    DB::table('rounds')->insert($rounds);
  }


}
