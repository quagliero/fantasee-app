<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayoffsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('playoffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('match_id')->unsigned()->unique();
            $table->foreign('match_id')->references('id')->on('matches');
            $table->enum('type', array('championship', 'consolation'));
            $table->enum('stage', array('other', 'quarter', 'semi', 'final'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('playoffs', function (Blueprint $table) {
            $table->dropForeign('playoffs_match_id_foreign');
            $table->drop();
        });
    }
}
