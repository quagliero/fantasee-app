<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('managers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('site_id');
			$table->integer('league_id')->unsigned();
			$table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
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
		Schema::table('managers', function(Blueprint $table)
		{
			$table->dropForeign('managers_league_id_foreign');
			$table->drop();
		});
	}

}
