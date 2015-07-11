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

  public function setUp() {
    parent::setUp();
    $this->createTestableLeague();
  }

  public function testShouldBeAbleToTradeAPlayerBetweenTeams() {
    /* Preparation */
    $traded_player = factory(Player::class)->create();
    $t1r = $this->teams[0]->rosterForWeek($this->week->id);
    $t1r->players()->save($traded_player);

    /* Perform trade */
    $trade = TradeBuilder::begin();

    $trade->inLeague($this->league->id)
      ->inWeek($this->week->id);

    $trade->player($traded_player->id)->to($this->teams[1]->id);

    $trade->finalize();

    /* gather the results */
    $team1p = $this->teams[0]->rosterForWeek($this->week->id)->players->filter(function ($p) use ($traded_player) {
      return $p->id == $traded_player->id;
    });

    $team2p = $this->teams[1]->rosterForWeek($this->week->id)->players->filter(function ($p) use ($traded_player) {
      return $p->id == $traded_player->id;
    });

    /* assertions */
    $this->assertEquals(count($team1p), 0, 'Player has not been removed from team 1');

    $this->assertEquals(count($team2p), 1, 'Player has not been added to team 2');
  }

  private function createTestableLeague() {
    $this->user = factory(User::class)->create();
    $this->league = factory(League::class)->create([ 'user_id' => $this->user->id ]);
    $this->season = factory(Season::class)->create();
    $this->week = factory(Week::class)->create();
    $this->managers = factory(Manager::class, 2)->create([ 'league_id' => $this->league->id ]);
    $this->teams = factory(Team::class, 2)->create([
      'league_id' => $this->league->id,
      'season_id' => $this->season->id,
      'manager_id' => 1,
    ])->each(function ($team, $i) {
      $team->manager_id = $i + 1;
      $team->save();
    });
    $this->rosters = factory(Roster::class, 2)->create([
     'week_id' => $this->week->id,
     'team_id' => 1,
    ])->each(function ($roster, $i) {
      $roster->team_id = $i + 1;
      $roster->save();
    });
    factory(Player::class, 15)->create()->each(function ($p) {
      $this->rosters[0]->players()->save($p);
    });
    factory(Player::class, 15)->create()->each(function ($p) {
      $this->rosters[1]->players()->save($p);
    });
  }
}
