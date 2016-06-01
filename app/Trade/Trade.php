<?php

namespace Fantasee\Trade;

use Fantasee\Week;
use Fantasee\League;
use Fantasee\Season;
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
  protected $fillable = ['external_id', 'league_id', 'season_id', 'week_id', 'trade_status_id'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [];

  public function getSummaryAttribute() {
    $c = [];

    foreach ($this->exchanges as $e) {
      $c[$e->gainingTeam->id]['gains'][$e->asset_type][] = $e->asset->id;
      $c[$e->losingTeam->id]['gives'][$e->asset_type][] = $e->asset->id;
    }

    return $c;
  }

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

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
