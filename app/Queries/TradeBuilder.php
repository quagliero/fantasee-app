<?php

namespace Fantasee\Queries;

use Fantasee\League;
use Fantasee\Week;
use Fantasee\Player;
use Fantasee\Team;

class TradeBuilder {

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
    $this->player = Player::findOrFail($player);

    return $this;
  }

  public function to($team) {
    $this->receiving_team = Team::findOrFail($team);

    return $this;
  }
  
  public function finalize() {
    // TODO: do this
  }
}
