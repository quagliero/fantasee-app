<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $users = [
          ['name' => 'Tobias',
          'email' => 'tobiaswhd@mgail.com',
          'password' => 'fantasee']
        ];

        DB::table('users')->insert($users);
    }

}
