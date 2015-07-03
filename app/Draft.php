<?php namespace Fantasee;

use DB;
use Fantasee\Traits\HasDraftPicks;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model {
	use HasDraftPicks;

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

	/**
	 * The picks in this draft
	 *
	 * @return array
	 */
	public function picks()
	{
		return $this->hasMany('Fantasee\Pick');
	}

	/**
	 * All drafts in a specific league
	 *
	 * @return array
	 */
	public function scopeByLeague($query, $league_id)
	{
		return $query->where('league_id', $league_id);
	}

	/**
	 * All drafts in a specific season
	 *
	 * @return array
	 */
	public function scopeBySeason($query, $season_id)
	{
		return $query->where('season_id', $season_id);
	}

	/**
	 * All picks of this draft
	 *
	 * @return array
	 */
	public function getAllPicks()
	{
		return $this->picks()->get();
	}

	/**
	 * First pick of this draft
	 */
	public function getFirstPick()
	{
		return $this->picks()->orderBy('pick')->first();
	}

	/**
	 * Last pick of this draft
	 * Mr Irrelivant
	 */
	public function getLastPick()
	{
		return $this->picks()->orderBy('pick', 'desc')->first();
	}

	/**
	 * Get all of a certain position
	 */
	public function getByPosition($position)
	{
		return DB::table('players')
			->join('picks', 'players.id', '=', 'picks.player_id')
			->join('drafts', 'picks.draft_id', '=', 'drafts.id')
			->where('players.position', $position)
			->where('drafts.id', $this->id)
			->get();
	}

}
