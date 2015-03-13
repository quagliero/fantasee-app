<?php namespace Fantasee;

use Illuminate\Database\Eloquent\Model;

class League extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'leagues';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['league_id', 'name', 'slug'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The teams attached to this league.
	 *
	 * @return array
	 */
	public function teams()
	{
		return $this->hasMany('Fantasee\Team');
	}

	/**
	 * The seasons attached to this league.
	 *
	 * @return array
	 */
	public function seasons()
	{
		return $this->belongsToMany('Fantasee\Season');
	}

}
