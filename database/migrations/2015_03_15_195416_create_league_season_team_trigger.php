<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueSeasonTeamTrigger extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared('
        CREATE TRIGGER tr_League_Season_Team AFTER INSERT ON `teams` FOR EACH ROW
        BEGIN
         INSERT INTO league_season_team (`league_id`, `season_id`, `team_id`) VALUES (NEW.league_id, NEW.season_id, NEW.id);
        END
      ');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::unprepared('DROP TRIGGER `tr_League_Season_Team`');
	}

}
