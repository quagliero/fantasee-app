<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueSeasonWeekPivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('league_season_week', function(Blueprint $table)
		{
			$table->integer('league_id')->unsigned()->index();
			$table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
			$table->integer('season_id')->unsigned()->index();
			$table->foreign('season_id')->references('id')->on('seasons');

			$table->integer('week_id')->unsigned()->index();
			$table->foreign('week_id')->references('id')->on('weeks');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('league_season_week');
	}

}
