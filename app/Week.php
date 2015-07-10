<?php namespace Fantasee;

use Illuminate\Database\Eloquent\Model;

class Week extends Model {
	/**
	 * WEEK with id of 18 is classed as offseason
	 */
	const OFF_SEASON_ID = 18;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'weeks';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}
