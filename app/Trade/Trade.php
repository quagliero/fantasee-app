<?php

namespace Fantasee\Trade;

use Fantasee\Week;
use Fantasee\League;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    public function exchanges() {
      return $this->hasMany(Exchange::class);
    }

    public function week() {
      return $this->belongsTo(Week::class);
    }

    public function tradeStatus() {
      return $this->belongsTo(TradeStatus::class);
    }

    public function league() {
      return $this->belongsTo(League::class);
    }
}
