<?php namespace Fantasee;

use Illuminate\Database\Eloquent\Model;

class LeagueSeasonWeek extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'league_season_week';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['league_id', 'season_id', 'week_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * Timestamps not required for this
	 */
	public $timestamps = false;

}
