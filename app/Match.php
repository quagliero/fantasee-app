<?php namespace Fantasee;

use Illuminate\Database\Eloquent\Model;

class Match extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'matches';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['league_id', 'season_id', 'week_id', 'team1_id', 'team2_id', 'team1_score', 'team2_score'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The league attached to this match
	 *
	 * @return array
	 */
	public function league()
	{
		return $this->belongsTo('Fantasee\League');
	}

	/**
	 * The teams attached to this match
	 *
	 * @return array
	 */
	public function season()
	{
		return $this->belongsTo('Fantasee\Season');
	}

	/**
	 * The teams attached to this match
	 *
	 * @return array
	 */
	public function teams()
	{
		return $this->belongsToMany('Fantasee\Team');
	}


	/**
	 * All matches in a specific league
	 *
	 * @return array
	 */
	public function scopeByLeague($query, $league_id)
	{
		return $query->where('league_id', $league_id);
	}

	/**
	 * All matches in a specific season
	 *
	 * @return array
	 */
	public function scopeBySeason($query, $season_id)
	{
		return $query->where('season_id', $season_id);
	}

	/**
	 * All matches involving a specific team
	 *
	 * @return array
	 */
	public function scopeByTeam($query, $team_id)
	{
		return $query->where('team1_id', $team_id)->orWhere('team2_id', $team_id);
	}

}
