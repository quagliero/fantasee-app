<?php

use Fantasee\Team;
use Fantasee\Trade\Exchange;
use Fantasee\Trade\Trade;

class TradeTest extends TestCase {
  public function testShouldGenerateASummaryOfTradedPlayers() {
    $team1 = factory(Team::class)->create();
    $team2 = factory(Team::class)->create();

    $trade = factory(Trade::class)->create();
    $trade->each(function ($u) use ($team1, $team2) {
        factory(Exchange::class, 10)->create([
          'trade_id' => $u->id
        ])
        ->each(function ($x) use ($team1, $team2) {
          $player = factory(\Fantasee\Player::class)->create();
          $even = rand(1, 100) % 2 == 0;

          $x->gaining_team_id = $even ? $team1->id : $team2->id;
          $x->losing_team_id = $even ? $team2->id : $team1->id;

          $x->asset()->associate($player);
      });
    });

    $output = $trade->summary;
    $this->assertNotNull($output);

    foreach ($trade->exchanges as $exchange) {
      $this->assertContains($exchange->asset->id, $output[$exchange->gainingTeam->id]['gains']);
      $this->assertContains($exchange->asset->id, $output[$exchange->losingTeam->id]['gives']);
    }
  }
}