<?php namespace Fantasee;

use Illuminate\Database\Eloquent\Model;

class Draft extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'drafts';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['league_id', 'season_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The league attached to this draft
	 *
	 * @return array
	 */
	public function league()
	{
		return $this->belongsTo('Fantasee\League');
	}

	/**
	 * The season attached to this draft
	 *
	 * @return array
	 */
	public function season()
	{
		return $this->belongsTo('Fantasee\Season');
	}

}
