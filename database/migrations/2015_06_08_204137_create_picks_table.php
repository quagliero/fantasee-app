<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('picks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('draft_id')->unsigned();
			$table->foreign('draft_id')->references('id')->on('drafts');
			$table->integer('team_id')->unsigned();
			$table->foreign('team_id')->references('id')->on('teams');
			$table->integer('player_id')->unsigned();
			$table->foreign('player_id')->references('id')->on('players');
			$table->integer('round');
			$table->integer('pick');
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
		Schema::table('picks', function (Blueprint $table)
		{
			$table->dropForeign('picks_team_id_foreign');
			$table->dropForeign('picks_player_id_foreign');
			$table->drop();
		});
	}

}
