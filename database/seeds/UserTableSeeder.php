<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $users = [
          ['name' => 'Tobias',
          'email' => 'tobiaswhd@gmail.com',
          'password' => bcrypt('fantasee'),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')],
          ['name' => 'Other',
          'email' => 'other@gmail.com',
          'password' => bcrypt('fantasee'),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')]
        ];

        DB::table('users')->insert($users);
    }

}
