<?php

namespace Fantasee\Trade;

use Fantasee\Team;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'exchanges';

  /**
   * The attributes that are mass assignable.
   * @var array
   */
  protected $fillable = [
    'trade_id',
    'gaining_team_id',
    'losing_team_id',
    'asset_id',
    'asset_type'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */
  protected $hidden = [];

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
