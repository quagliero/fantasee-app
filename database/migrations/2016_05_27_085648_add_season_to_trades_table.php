<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeasonToTradesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('trades', function (Blueprint $table) {
          $table->integer('season_id')->unsigned();
          $table->foreign('season_id')->references('id')->on('seasons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->dropForeign('trades_season_id_foreign');
        });
    }
}
