<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_statuses', function (Blueprint $table) {
          $table->increments('id');
          $table->string('display_text');
          $table->timestamps();
        });

        Schema::create('trades', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('league_id')->unsigned();
          $table->integer('week_id')->unsigned();
          $table->integer('trade_status_id')->unsigned();
          $table->timestamps();

          $table->foreign('league_id')->references('id')->on('leagues');
          $table->foreign('week_id')->references('id')->on('weeks');
          $table->foreign('trade_status_id')->references('id')->on('trade_statuses');
        });

        Schema::create('exchanges', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('trade_id')->unsigned();
          $table->integer('gaining_team_id')->unsigned();
          $table->integer('losing_team_id')->unsigned();
          $table->integer('asset_id')->unsigned();
          $table->string('asset_type');
          $table->timestamps();

          $table->foreign('trade_id')->references('id')->on('trades');
          $table->foreign('gaining_team_id')->references('id')->on('teams');
          $table->foreign('losing_team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('exchanges');
      Schema::drop('trades');
      Schema::drop('trade_statuses');
    }
}
