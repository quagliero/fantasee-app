<?php

namespace Fantasee\Trade;

use Fantasee\Team;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
  public function gainingTeam() {
    return $this->belongsTo(Team::class);
  }

  public function losingTeam() {
    return $this->belongsTo(Team::class);
  }

  public function trade() {
    return $this->belongsTo(Trade::class);
  }

  public function asset() {
    return $this->morphTo();
  }
}
