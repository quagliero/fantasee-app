<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drafts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('league_id')->unsigned();
			$table->foreign('league_id')->references('id')->on('leagues');
			$table->integer('season_id')->unsigned();
			$table->foreign('season_id')->references('id')->on('seasons');
			$table->integer('round_id')->unsigned();
			$table->foreign('round_id')->references('id')->on('rounds');
			$table->integer('pick');
			$table->integer('team_id')->unsigned();
			$table->foreign('team_id')->references('id')->on('teams');
			$table->integer('player_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('drafts', function (Blueprint $table)
		{
			$table->dropForeign('drafts_league_id_foreign');
			$table->dropForeign('drafts_season_id_foreign');
			$table->dropForeign('drafts_round_id_foreign');
			$table->drop();
		});
	}


}