<?php namespace Fantasee\Traits;

trait HasDraftPicks {

  /**
  * Get hash of draft statistics
  * $draft->selections->[first/last/positions]
  *
  * @return object
  */
  public function getSelectionsAttribute()
  {
    $object = new \StdClass;
    $object->positions = new \StdClass;

    /**
     * first Pick of first player in the draft
     * @var Fantasee\Pick
     */
    $object->first = $this->getFirstPick();

    /**
     * last Pick of last player in the draft
     * @var Fantasee\Pick
     */
    $object->last = $this->getLastPick();

    /**
     * positions->qb Array of all QBs taken in the draft
     * @var array
     */
    $object->positions->qb = $this->getByPosition('QB');

    /**
     * positions->rb Array of all RBs taken in the draft
     * @var array
     */
    $object->positions->rb = $this->getByPosition('RB');

    /**
     * positions->wr Array of all WRs taken in the draft
     * @var array
     */
    $object->positions->wr = $this->getByPosition('WR');

    /**
     * positions->te Array of all TEs taken in the draft
     * @var array
     */
    $object->positions->te = $this->getByPosition('TE');

    /**
     * positions->k Array of all Ks taken in the draft
     * @var array
     */
    $object->positions->k = $this->getByPosition('K');
    
    /**
     * positions->dst Array of all D/STs taken in the draft
     * @var array
     */
    $object->positions->dst = $this->getByPosition('DEF');

    return $object;
  }
}
