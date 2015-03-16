<?php namespace Fantasee;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'teams';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['league_id', 'name', 'manager_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The manager of this team
	 *
	 * @var array
	 */
	public function manager()
	{
		return $this->belongsTo('Fantasee\Manager');
	}

	/**
	 * The season of this team
	 *
	 * @var array
	 */
	public function season()
	{
		return $this->belongsTo('Fantasee\Season');
	}

	/**
	 * Get a team by its season
	 *
	 * @var array
	 */
	public function scopeBySeason($query, $season_id)
	{
		return $query->where('season_id', $season_id);
	}
}
