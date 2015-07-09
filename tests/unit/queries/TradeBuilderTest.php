<?php

use Fantasee\League;
use Fantasee\Week;
use Fantasee\Team;
use Fantasee\Player;
use Fantasee\User;
use Fantasee\Manager;
use Fantasee\Season;
use Fantasee\Roster;

use Fantasee\Queries\TradeBuilder;

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

    factory(Roster::class)->create([
     'week_id' => $week->id,
     'team_id' => $team1->id,
    ]);
    factory(Roster::class)->create([
     'week_id' => $week->id,
     'team_id' => $team2->id,
    ]);

    $t1r = $team1->rosterForWeek($week->id);
    $t2r = $team2->rosterForWeek($week->id);

    $t1r->players()->save($traded_player);

    factory(Player::class, 15)->create()->each(function ($p) use ($t1r) {
      $t1r->players()->save($p);
    });
    factory(Player::class, 15)->create()->each(function ($p) use ($t2r) {
      $t2r->players()->save($p);
    });



    $trade = TradeBuilder::begin();

    $trade->inLeague($league->id)
      ->inWeek($week->id);

    $trade->player($traded_player->id)->to($team1->id);

    $trade->finalize();

    // assertions
    $players = $team1->rosterForWeek($week->id)->players->filter(function ($p) use ($traded_player) {
      return $p->id == $traded_player->id;
    });

    $this->assertEquals(count($players), 0, 'Player has not been removed from team 1');

    $players = $team2->rosterForWeek($week->id)->players->filter(function ($p) use ($traded_player) {
      return $p->id == $traded_player->id;
    });

    $this->assertEquals(count($players), 1, 'Player has not been added to team 2');
  }
}
