<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rosters', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('team_id')->unsigned();
          $table->integer('week_id')->unsigned();
          $table->timestamps();

          $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
          $table->foreign('week_id')->references('id')->on('weeks')->onDelete('cascade');
        });

        Schema::create('player_roster', function (Blueprint $table) {
          $table->integer('roster_id')->unsigned();
          $table->integer('player_id')->unsigned();

          $table->primary(['roster_id', 'player_id']);
          $table->foreign('roster_id')->references('id')->on('rosters')->onDelete('cascade');
          $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('player_roster');
        Schema::drop('rosters');
    }
}
