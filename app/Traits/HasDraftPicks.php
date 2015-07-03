<?php namespace Fantasee\Traits;

trait HasDraftPicks {

  /**
  * Get hash of draft statistics
  *
  * @var number
  */
  public function getPlayersAttribute()
  {
    $object = new \StdClass;
    $object->positions = new \StdClass;

    $object->all = $this->getAllPicks();
    $object->first = $this->getFirstPick();
    $object->last = $this->getLastPick();

    $object->positions->qb = $this->getByPosition('QB');
    $object->positions->rb = $this->getByPosition('RB');
    $object->positions->wr = $this->getByPosition('WR');
    $object->positions->te = $this->getByPosition('TE');
    $object->positions->k = $this->getByPosition('K');
    $object->positions->dst = $this->getByPosition('DEF');

    return $object;
  }
}
