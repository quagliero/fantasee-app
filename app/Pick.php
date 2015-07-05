<?php namespace Fantasee;

use Fantasee\Traits\HasDraftPicks;
use Illuminate\Database\Eloquent\Model;

class Pick extends Model {
	use HasDraftPicks;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'picks';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['draft_id', 'team_id', 'player_id', 'round', 'pick'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The draft attached to this pick
	 *
	 * @return array
	 */
	public function draft()
	{
		return $this->belongsTo('Fantasee\Draft');
	}

	/**
	 * The team attached to this pick
	 *
	 * @return array
	 */
	public function team()
	{
		return $this->belongsTo('Fantasee\Team');
	}

	/**
	 * The player attached to this pick
	 *
	 * @return array
	 */
	public function player()
	{
		return $this->belongsTo('Fantasee\Player');
	}

	/**
	 * Return a collection of picks by a Draft
	 *
	 * @return array
	 */
	public function scopeByDraft($query, $draft_id)
	{
		return $query->where('draft_id', $draft_id);
	}

}
