<?php

namespace Fantasee\Queries;

use Fantasee\League;
use Fantasee\Week;
use Fantasee\Player;
use Fantasee\Team;
use Fantasee\Roster;
use Fantasee\Trade\Trade;
use Fantasee\Trade\Exchange;

class TradeBuilder {

  protected $week;
  protected $league;
  protected $trades = [];

  private $pending_exchange;

  public static function begin() {
    return new TradeBuilder;
  }

  public function inLeague($league) {
    $this->league = League::findorFail($league);

    return $this;
  }

  public function inWeek($week) {
    $this->week = Week::findOrFail($week);

    return $this;
  }

  public function player($player) {

    if ($this->pending_exchange != null) {
      throw new Exception('Attempted to initiate player trade, but previous trade attempt has not been completed. Use `to()` to assign a team.');
    }
    $this->pending_exchange = $player;

    return $this;
  }

  public function to($team) {
    $this->trades[] = [ 'player' => $this->pending_exchange, 'team' => $team ];

    $this->pending_exchange = null;

    return $this;
  }

  public function finalize() {
    \DB::transaction(function () {
      $trade = new Trade;

      $trade->week_id = $this->week->id;
      $trade->league_id = $this->league->id;
      $trade->trade_status_id = 1; // TODO: NYI

      $trade->save();

      foreach ($this->trades as $t) {
        // Update losing teams roster
        $player = Player::findOrFail($t['player']);
        $gaining_team = Team::findOrFail($t['team']);

        $losing_team = Team::where('league_id', $this->league->id)
          ->whereHas('rosters', function ($q) use ($player) {
            $q->where('week_id', $this->week->id)
              ->whereHas('players', function ($sq) use ($player) {
                $sq->where('id', $player->id);
              });
          })
          ->first();

        $losing_team->rosterForWeek($this->week->id)->players()->detach($player->id);
        $gaining_team->rosterForWeek($this->week->id)->players()->attach($player->id);

        // Add to trade
        $exchange = new Exchange;
        $exchange->trade_id = $trade->id;
        $exchange->gaining_team_id = $gaining_team->id;
        $exchange->losing_team_id = $losing_team->id;
        $exchange->asset_id = $player;
        $exchange->asset_type = Player::class;
        $exchange->save();

        $trade->exchanges()->save($exchange);
        $trade->exchanges()->save($exchange);
        $trade->exchanges()->save($exchange);
      }
    });
  }
}
