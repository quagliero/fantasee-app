<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $users = [
          ['name' => 'Tobias',
          'email' => 'tobiaswhd@gmail.com',
          'password' => bcrypt('fantasee')],
          ['name' => 'Other',
          'email' => 'other@gmail.com',
          'password' => bcrypt('fantasee')]
        ];

        DB::table('users')->insert($users);
    }

}
