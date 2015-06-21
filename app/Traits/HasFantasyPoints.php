<?php namespace Fantasee\Traits;

trait HasFantasyPoints {

  /**
  * Get points attributes
  *
  * @var number
  */
  public function getPointsAttribute()
  {
    $object = new \StdClass;

    $object->for = $this->getPointsFor();
    $object->against = $this->getPointsAgainst();

    return $object;
  }
}
