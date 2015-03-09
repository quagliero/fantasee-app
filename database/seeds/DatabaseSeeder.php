<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UsersTableSeeder');
		$this->command->info('Users table seeded!');

		$this->call('SeasonsTableSeeder');
		$this->command->info('Seasons table seeded!');

		$this->call('LeaguesTableSeeder');
		$this->command->info('Leagues table seeded!');

		$this->call('ManagersTableSeeder');
		$this->command->info('Managers table seeded!');

		$this->call('TeamsTableSeeder');
		$this->command->info('Teams table seeded!');
	}

}
