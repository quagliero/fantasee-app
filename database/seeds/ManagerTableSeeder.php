<?php

use Fantasee\League;
use Illuminate\Database\Seeder;

class ManagerTableSeeder extends DatabaseSeeder {

    public function run() {
      $this->runChumboSeed();
      $leagues = League::where('id', '!=', 1)->get();

      $leagues->each(function ($l) {
        $numberManagers = rand(4, 10);
        factory(\Fantasee\Manager::class, $numberManagers)
          ->create()
          ->each(function ($m) use ($l) {
            $m->league_id = $l->id;
            $m->save();
          });
      });
    }
    public function runChumboSeed()
    {
        $managers = [
          [
            'name' => 'Jimmie',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Dan',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Karsten',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Tobias',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Jason',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Dave',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Fintan',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Andrew',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Anthony',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Rich',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Dave',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Euan',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Chris',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
          [
            'name' => 'Sol',
            'league_id' => 1,
            'site_id' => mt_rand(100,1000),
          ],
        ];

        foreach ($managers as &$s) {
          $s['created_at'] = date('Y-m-d H:i:s');
          $s['updated_at'] = date('Y-m-d H:i:s');
        }

        DB::table('managers')->insert($managers);
    }

}
