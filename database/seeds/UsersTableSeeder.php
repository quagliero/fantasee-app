<?php
class UsersTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('users')->truncate();

        User::create([
          'name' => 'Tobias',
          'email' => 'tobiaswhd@mgail.com',
          'password' => 'fantasee'
        ]);

    }

}
