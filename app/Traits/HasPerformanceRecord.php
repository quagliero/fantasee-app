<?php namespace Fantasee\Traits;

trait HasPerformanceRecord {
  /**
  * Get hash of team statistics
  *
  * @var number
  */
  public function getPerformanceAttribute()
  {
    return [
      'wins'   => $this->wins,
      'losses' => $this->losses,
      'ties'   => $this->ties,
    ];
  }
}
