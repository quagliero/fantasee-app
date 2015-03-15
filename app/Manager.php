<?php namespace Fantasee;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'managers';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'league_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The teams attached to a manager of a league.
	 *
	 * @return array
	 */
	public function teams()
	{
		return $this->hasMany('Fantasee\Team');
	}


	/**
	 * The team attached to a specific season of a manager in a league.
	 *
	 * @return array
	 */
	public function team($season_id)
	{
		return $this->hasMany('Fantasee\Team')->where('season_id', $season_id)->first();
	}
}
