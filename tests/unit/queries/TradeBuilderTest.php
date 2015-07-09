<?php

use Fantasee\League;
use Fantasee\Week;
use Fantasee\Team;
use Fantasee\Player;
use Fantasee\User;
use Fantasee\Manager;
use Fantasee\Season;

class TradeBuilderTest extends TestCase {
  public function testShouldBeAbleToTradeAPlayerBetweenTeams() {
    $user = factory(User::class)->create();
    $league = factory(League::class)->create([ 'user_id' => $user->id ]);
    $season = factory(Season::class)->create();
    $week = factory(Week::class)->create();
    $mgr1 = factory(Manager::class)->create([ 'league_id' => $league->id ]);
    $mgr2 = factory(Manager::class)->create([ 'league_id' => $league->id ]);
    $team1 = factory(Team::class)->create([
      'league_id' => $league->id,
      'manager_id' => $mgr1->id,
      'season_id' => $season->id,
    ]);
    $team2 = factory(Team::class)->create([
      'league_id' => $league->id,
      'manager_id' => $mgr2->id,
      'season_id' => $season->id,
    ]);
    $traded_player = factory(Player::class)->create();

    factory(Player::class, 15)->create();
    factory(Player::class, 15)->create();

    $trade = TradeBuilder::begin();

    $trade->inLeague($league->id)
      ->inWeek($week->id);

    $trade->player($traded_player->id)->to($team1->id);

    $trade->finalize();

    // assertions
  }
}
