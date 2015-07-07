<?php namespace Fantasee;

use DB;
use Fantasee\Traits\HasDraftPicks;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model {
	use HasDraftPicks;

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'drafts';

	/**
	 * The attributes that are mass assignable.
	 * @var array
	 */
	protected $fillable = ['league_id', 'season_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The league attached to this draft
	 * @return array
	 */
	public function league()
	{
		return $this->belongsTo('Fantasee\League');
	}

	/**
	 * The season attached to this draft
	 * @return array
	 */
	public function season()
	{
		return $this->belongsTo('Fantasee\Season');
	}

	/**
	 * The picks in this draft
	 * @return array
	 */
	public function picks()
	{
		return $this->hasMany('Fantasee\Pick');
	}

	/**
	 * All drafts in a specific league
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
	 * @return array
	 */
	public function getAllPicks()
	{
		return $this->picks()->get();
	}

	/**
	 * First pick of this draft
	 * @return Fantasee\Pick
	 */
	public function getFirstPick()
	{
		return $this->picks()->orderBy('pick')->first();
	}

	/**
	 * Last pick of this draft
	 * Mr Irrelivant
	 * @return Fantasee\Pick
	 */
	public function getLastPick()
	{
		return $this->picks()->orderBy('pick', 'desc')->first();
	}

	/**
	 * Get all of a certain position
	 * @param  string $position
	 * @return Illuminate\Database\Collection
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

	/**
	 * Get all of a certain position by round
	 * @param  string $position
	 * @param  integer $round
	 * @return Illuminate\Database\Collection
	 */
	public function getByPositionByRound($position, $round)
	{
		return DB::table('players')
			->join('picks', 'players.id', '=', 'picks.player_id')
			->join('drafts', 'picks.draft_id', '=', 'drafts.id')
			->where('players.position', $position)
			->where('drafts.id', $this->id)
			->where('picks.round', $round)
			->get();
	}

	/**
	 * getAllPicksByRound returns a Collection containing the picks of a provided round
	 * number, or if none is provided, returns the entire draft as an array of Collections
	 * @param  integer $round
	 * @return mixed
	 */
	public function getAllPicksByRound($round = '')
	{
		if ($round) {
			return $this->picks->where('round', $round)->orderBy('pick')->get();
		} else {
			$roundSize = sizeof($this->picks()->where('round', 1)->get());
			return $this->picks->sortBy('pick')->chunk($roundSize);
		}
	}

	/**
	 * getAllPicksByRoundWithBreakdown returns getAllPicksByRound with additional
	 * data breaking down the stats of the round
	 * @param  integer $round
	 * @return mixed
	 */
	public function getAllPicksByRoundWithBreakdown($round = '')
	{
		$rounds = $this->getAllPicksByRound($round);
		// add in 'breakdown' object for each round
		$rounds->each(function ($r) {
			$positions = $r->map(function ($pick) {
		    return $pick->player->position;
		  });
			$length = sizeof($positions);
			$unique = array_count_values($positions->toArray());

			foreach($unique as $key => $val) {
		    $perc = rtrim(number_format($val / $length * 100, 2), '.00');
				$r->breakdown[strtolower($key)] = $perc;
		  }

		});

		return $rounds;
	}
}
