<?php

use Fantasee\League;

class TradeBuilderTest extends TestCase {
  public function testShouldBeAbleToTradeAPlayerBetweenTeams() {
    $league = factory(League::class)->create();
    $week = factory(Week::class)->create();
    $team1 = factory(Team::class)->create([ 'league_id' => $league->id ]);
    $team2 = factory(Team::class)->create([ 'league_id' => $league->id ]);
    $traded_player = factory(Player::class)->create([ 'team_id' => $team1->id ]);

    factory(Player::class, 15)->create([ 'team_id' => $team1->id ]);
    factory(Player::class, 15)->create([ 'team_id' => $team2->id ]);

    $trade = TradeBuilder::begin();

    $trade->inLeague($league->id)
      ->inWeek($week->id);

    $trade->player($traded_player->id)->to($team1->id);

    $trade->finalize();

    // assertions
  }
}
