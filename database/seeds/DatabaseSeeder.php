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

		$this->call('WeekTableSeeder');
		$this->command->info('Weeks table seeded!');

		$this->call('RoundTableSeeder');
		$this->command->info('Rounds table seeded!');

		$this->call('LeagueSeasonTableSeeder');
		$this->command->info('League Season table seeded!');

		$this->call('LeagueSeasonWeekTableSeeder');
		$this->command->info('League Season Week table seeded!');

		$this->call('ManagerTableSeeder');
		$this->command->info('Managers table seeded!');

		$this->call('TeamTableSeeder');
		$this->command->info('Teams table seeded!');

		$this->call('MatchTableSeeder');
		$this->command->info('Matches table seeded!');

		$this->call('DraftTableSeeder');
		$this->command->info('Drafts table seeded!');

		$this->call('TradeSeeder');
		$this->command->info('Trade table seeded!');

		$this->call('AddOffseasonToWeeksTableSeeder');
		$this->command->info('Offseason added to Week table!');
	}

}
