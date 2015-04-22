<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teams', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('league_id')->unsigned();
			$table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
			$table->integer('manager_id')->unsigned();
			$table->foreign('manager_id')->references('id')->on('managers')->onDelete('cascade');;
			$table->integer('season_id')->unsigned();
			$table->foreign('season_id')->references('id')->on('seasons');
			$table->string('name');
			$table->integer('position');
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
		Schema::table('teams', function (Blueprint $table)
		{
			$table->dropForeign('teams_league_id_foreign');
			$table->dropForeign('teams_season_id_foreign');
			$table->dropForeign('teams_manager_id_foreign');
			$table->drop();
		});
	}

}
