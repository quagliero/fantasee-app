<?php

use Illuminate\Database\Seeder;

class WeekTableSeeder extends Seeder {

    public function run()
    {
      $maxWeeks = 17;
      $weeks = [];

      for($i = 1; $i <= $maxWeeks; $i++) {
        $weeks[] = [
          'name' => 'Week ' . $i
        ];
      }

      DB::table('weeks')->insert($weeks);
    }

}
