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
	protected $fillable = ['league_id', 'user_id', 'name', 'slug'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * Slug should be formatted as URL friendly
	 *
	 * @var array
	 */
	public function setSlugAttribute($slug)
	{
		$this->attributes['slug'] = str_slug($slug);
	}

	/**
	 * All teams attached to this league.
	 *
	 * @return array
	 */
	public function teams()
	{
		return $this->hasMany('Fantasee\Team');
	}

	/**
	* All teams attached to this league.
	*
	* @return array
	*/
	public function managers()
	{
		return $this->hasMany('Fantasee\Manager');
	}

	/**
	 * All seasons attached to this league.
	 *
	 * @return array
	 */
	public function seasons()
	{
		return $this->belongsToMany('Fantasee\Season');
	}

	/**
	 * All matches attached to this league.
	 *
	 * @return array
	 */
	public function matches()
	{
		return $this->hasMany('Fantasee\Match');
	}

	/**
	 * All drafts attached to this league.
	 *
	 * @return array
	 */
	public function drafts()
	{
		return $this->hasMany('Fantasee\Draft');
	}

	/**
	* Get the weeks attached to a specific season of this league.
	*
	* @return array
	*/
	public function seasonWeeks($season_id)
	{
		return $this->belongsToMany('Fantasee\Week', 'league_season_week')->wherePivot('season_id', $season_id);
	}

}
