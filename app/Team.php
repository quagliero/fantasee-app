<?php namespace Fantasee;

use Fantasee\Traits\HasFantasyPoints;
use Fantasee\Traits\HasPerformanceRecord;
use Illuminate\Database\Eloquent\Model;

class Team extends Model {
	use HasFantasyPoints;
	use HasPerformanceRecord;

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
	protected $fillable = ['league_id', 'name', 'manager_id', 'season_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The league of this team
	 *
	 * @var array
	 */
	public function league()
	{
		return $this->belongsTo('Fantasee\League');
	}

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
	 * The 'home' matches of this team
	 *
	 * @var array
	 */
	public function homeMatches()
	{
		return $this->hasMany('Fantasee\Match', 'team1_id');
	}

	/**
	 * The 'away' matches of this team
	 *
	 * @var array
	 */
	public function awayMatches()
	{
		return $this->hasMany('Fantasee\Match', 'team2_id');
	}

	/**
	 * The matches of this team
	 *
	 * @var array
	 */
	public function allMatches()
	{
		return $this->homeMatches->merge($this->awayMatches);
	}

	/**
	 * Get teams by their leagues
	 *
	 * @var array
	 */
	public function scopeByLeague($query, $league_id)
	{
		return $query->where('league_id', $league_id);
	}

	/**
	 * Get teams by their manager
	 *
	 * @var array
	 */
	public function scopeByManager($query, $manager_id)
	{
		return $query->where('manager_id', $manager_id);
	}

	/**
	 * Get teams by their season
	 *
	 * @var array
	 */
	public function scopeBySeason($query, $season_id)
	{
		return $query->where('season_id', $season_id);
	}

	/**
	 * Get team wins by their season
	 *
	 * @var array
	 */
	public function getWinsAttribute()
	{
		$wins = $this->allMatches()->filter(function ($match)
		{
		  $home = $this->id == $match->team1_id;
		  if ($home && $match->team1_score > $match->team2_score) {
		    return $match;
		  }
		  if (!$home && $match->team2_score > $match->team1_score) {
		    return $match;
		  }
		})->count();

		return $wins;
	}

	/**
	 * Get team losses by their season
	 *
	 * @var array
	 */
	public function getLossesAttribute()
	{
		$wins = $this->allMatches()->filter(function ($match)
		{
		  $home = $this->id == $match->team1_id;
		  if ($home && $match->team1_score < $match->team2_score) {
		    return $match;
		  }
		  if (!$home && $match->team2_score < $match->team1_score) {
		    return $match;
		  }
		})->count();

		return $wins;
	}

	/**
	 * Get team ties by their season
	 *
	 * @var array
	 */
	public function getTiesAttribute()
	{
		$wins = $this->allMatches()->filter(function ($match)
		{
		  if ($match->team1_score == $match->team2_score) {
		    return $match;
		  }
		})->count();

		return $wins;
	}

	/**
	 * Get team points by their season
	 *
	 * @var array
	 */
	public function getPointsFor()
	{
		$pointsFor = $this->allMatches()->reduce(function ($score, $match)
		{
			$weekScore = ($this->id == $match->team1_id) ? $match->team1_score : $match->team2_score;

			return $score += $weekScore;
		});

		return $pointsFor;
	}

	/**
	 * Get team points against by their season
	 *
	 * @var array
	 */
	public function getPointsAgainst()
	{
		$pointsFor = $this->allMatches()->reduce(function ($score, $match)
		{
			$weekScore = ($this->id == $match->team1_id) ? $match->team2_score : $match->team1_score;

			return $score += $weekScore;
		});

		return $pointsFor;
	}

	/**
	* Get team win percentage
	*
	* @var number
	*/
	public function getWinPercent()
	{
		$total = array_sum( $this->performance );

		if ($total == 0) {
			return 0;
		}

		return ($this->wins / $total) * 100;
	}
}
