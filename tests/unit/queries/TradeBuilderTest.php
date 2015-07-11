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

  const NUM_TEST_TEAMS = 3;

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
      ->inWeek($this->week->id)
      ->inSeason($this->season->id);

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

  public function testShouldBeAbleToTradeMultiplePlayersInASingleTrade() {
    $roster = $this->rosters[0];
    $players = factory(Player::class, 5)
      ->create()
      ->each(function ($p) use ($roster) {
        $roster->players()->save($p);
    });

    $trade = TradeBuilder::begin();

    $trade->inLeague($this->league->id)->inWeek($this->week->id)->inSeason($this->season->id);

    foreach ($players as $player) {
      $trade->player($player->id)->to($this->teams[1]->id);
    }

    $trade->finalize();

    $team1pids = $roster->players->lists('id')->toArray();
    $team2pids = $this->rosters[1]->players->lists('id')->toArray();

    foreach ($players as $player) {
      $this->assertFalse(in_array($player->id, $team1pids));
      $this->assertTrue(in_array($player->id, $team2pids));
    }
  }

  public function testShouldBeAbleToTradeMultiplePlayersBetweenTwoTeamsInASingleTrade() {
    $rosterA = $this->rosters[0];
    $rosterB = $this->rosters[1];

    $playersA = factory(Player::class, 3)->create()
      ->each(function ($p, $i) use ($rosterA) {
        $rosterA->players()->save($p);
    });

    $playersB = factory(Player::class, 3)->create()
      ->each(function ($p, $i) use ($rosterB) {
        $rosterB->players()->save($p);
    });

    $trade = TradeBuilder::begin();

    $trade->inLeague($this->league->id)->inWeek($this->week->id)->inSeason($this->season->id);

    foreach ($playersA as $p) {
      $trade->player($p->id)->to($this->teams[1]->id);
    }

    foreach ($playersB as $p) {
      $trade->player($p->id)->to($this->teams[0]->id);
    }

    $trade->finalize();

    $team1pids = $rosterA->players->lists('id')->toArray();
    $team2pids = $rosterB->players->lists('id')->toArray();

    foreach ($playersA as $p) {
      $this->assertFalse(in_array($p->id, $team1pids));
      $this->assertTrue(in_array($p->id, $team2pids));
    }

    foreach ($playersB as $p) {
      $this->assertTrue(in_array($p->id, $team1pids));
      $this->assertFalse(in_array($p->id, $team2pids));
    }
  }

  public function testShouldBeAbleToTradePlayersBetweenMultipleTeamsInASingleTrade() {
    $teamA = $this->teams[0];
    $teamB = $this->teams[1];
    $teamC = $this->teams[2];

    $tradeA = factory(Player::class)->create();
    $this->rosters[0]->players()->save($tradeA);

    $tradeB = factory(Player::class)->create();
    $this->rosters[1]->players()->save($tradeB);

    $tradeC = factory(Player::class)->create();
    $this->rosters[2]->players()->save($tradeC);

    $trade = TradeBuilder::begin();

    $trade->inLeague($this->league->id)->inSeason($this->season->id)->inWeek($this->week->id);

    $trade->player($tradeA->id)->to($teamB->id);
    $trade->player($tradeB->id)->to($teamC->id);
    $trade->player($tradeC->id)->to($teamA->id);

    $trade->finalize();

    $playersA = $this->rosters[0]->players->lists('id')->toArray();
    $playersB = $this->rosters[1]->players->lists('id')->toArray();
    $playersC = $this->rosters[2]->players->lists('id')->toArray();

    $this->assertFalse(in_array($tradeA->id, $playersA));
    $this->assertTrue(in_array($tradeA->id, $playersB));

    $this->assertFalse(in_array($tradeB->id, $playersB));
    $this->assertTrue(in_array($tradeB->id, $playersC));

    $this->assertFalse(in_array($tradeC->id, $playersC));
    $this->assertTrue(in_array($tradeC->id, $playersA));

  }

  private function createTestableLeague() {
    $this->user = factory(User::class)->create();
    $this->league = factory(League::class)->create([ 'user_id' => $this->user->id ]);
    $this->season = factory(Season::class)->create();
    $this->week = factory(Week::class)->create();
    $this->managers = factory(Manager::class, self::NUM_TEST_TEAMS)->create([ 'league_id' => $this->league->id ]);
    $this->teams = factory(Team::class, self::NUM_TEST_TEAMS)->create([
      'league_id' => $this->league->id,
      'season_id' => $this->season->id,
      'manager_id' => 1,
    ])->each(function ($team, $i) {
      $team->manager_id = $i + 1;
      $team->save();
    });
    $this->rosters = factory(Roster::class, self::NUM_TEST_TEAMS)->create([
     'week_id' => $this->week->id,
     'team_id' => 1,
    ])->each(function ($roster, $i) {
      $roster->team_id = $i + 1;
      $roster->save();
    });

    $this->teams->each(function ($t, $i) {
      factory(Player::class, 15)->create()->each(function ($p) use ($i) {
        $this->rosters[$i]->players()->save($p);
      });
    });
  }
}
