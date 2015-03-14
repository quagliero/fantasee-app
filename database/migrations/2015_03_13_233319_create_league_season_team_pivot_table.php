<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueSeasonTeamPivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('league_season_team', function(Blueprint $table)
		{
			$table->integer('league_id')->unsigned()->index();
			$table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
			$table->integer('season_id')->unsigned()->index();
			$table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');

			$table->integer('team_id')->unsigned()->index();
			$table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('league_season_team');
	}

}
