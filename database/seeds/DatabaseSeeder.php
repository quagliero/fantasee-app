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

		$this->call('UserTableSeeder');
		$this->command->info('Users table seeded!');

		$this->call('SeasonTableSeeder');
		$this->command->info('Seasons table seeded!');

		$this->call('LeagueTableSeeder');
		$this->command->info('Leagues table seeded!');

		$this->call('LeagueSeasonTableSeeder');
		$this->command->info('League Season table seeded!');

		$this->call('ManagerTableSeeder');
		$this->command->info('Managers table seeded!');

		$this->call('TeamTableSeeder');
		$this->command->info('Teams table seeded!');

	}

}
