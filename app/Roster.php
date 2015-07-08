<?php

namespace Fantasee;

use Fantasee\Team;
use Fantasee\Week;
use Fantasee\Player;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    protected $fillable = ['*'];

    public function week() {
      return $this->belongsTo(Week::class);
    }

    public function team() {
      return $this->belongsTo(Team::class);
    }

    public function players() {
      return $this->belongsToMany(Player::class);
    }
}
