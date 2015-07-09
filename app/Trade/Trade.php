<?php

namespace Fantasee\Trade;

use Fantasee\Week;
use Fantasee\League;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'trades';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['league_id', 'week_id', 'trade_status_id'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [];

  public function exchanges()
  {
      return $this->hasMany(Exchange::class);
  }

  public function week()
  {
      return $this->belongsTo(Week::class);
  }

  public function tradeStatus()
  {
      return $this->belongsTo(TradeStatus::class);
  }

  public function league()
  {
      return $this->belongsTo(League::class);
  }
}
