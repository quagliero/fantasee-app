<?php

use Fantasee\Week;
use Fantasee\League;
use Fantasee\Player;
use Fantasee\Trade\Trade;
use Fantasee\Trade\TradeStatus;
use Fantasee\Trade\Exchange;
use Illuminate\Database\Seeder;

class TradeSeeder extends DatabaseSeeder {

    public function run()
    {
      $num_status = 5;
      $num_weeks = Week::count();
      $num_players = Player::count();
      $num_leagues = League::count();

      factory(TradeStatus::class, $num_status)->create();
      factory(Trade::class, 10)->create([
        'week_id'   => rand(1, $num_weeks),
        'trade_status_id' => rand(1, $num_status),
        'league_id' => 1
      ]);

      factory(Exchange::class, 3)->create([
        'gaining_team_id' => 1,
        'losing_team_id'  => 2,
        'asset_id'        => rand(1, $num_players),
        'asset_type'      => Player::class,
        'trade_id'        => rand(1, 3),
      ]);
    }

}
