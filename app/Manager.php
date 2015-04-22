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
	protected $fillable = ['name', 'league_id', 'site_id'];

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
	 * Get managers by their leagues
	 *
	 * @var array
	 */
	public function scopeByLeague($query, $league_id)
	{
		return $query->where('league_id', $league_id);
	}

	/**
	 * Get manager wins
	 *
	 * @var number
	 */
	public function getWins()
	{
		$totalWins = $this->teams->reduce(function ($wins, $team) {
			return $wins += $team->getWins();
		});

		return $totalWins;
	}

	/**
	 * Get manager losses
	 *
	 * @var number
	 */
	public function getLosses()
	{
		$totalLosses = $this->teams->reduce(function ($losses, $team) {
			return $losses += $team->getLosses();
		});

		return $totalLosses;
	}

	/**
	 * Get manager losses
	 *
	 * @var number
	 */
	public function getTies()
	{
		$totalTies = $this->teams->reduce(function ($ties, $team) {
			return $ties += $team->getTies();
		});

		return $totalTies;
	}

	/**
	 * Get manager points for
	 *
	 * @var number
	 */
	public function getPointsFor()
	{
		$totalPointsFor = $this->teams->reduce(function ($points, $team) {
			return $points += $team->getPointsFor();
		});

		return $totalPointsFor;
	}

	/**
	 * Get manager points against
	 *
	 * @var number
	 */
	public function getPointsAgainst()
	{
		$totalPointsAgainst = $this->teams->reduce(function ($points, $team) {
			return $points += $team->getPointsAgainst();
		});

		return $totalPointsAgainst;
	}

	/**
	* Get manager championship seasons
	*
	* @var number
	*/
	public function getChampionshipSeasons()
	{
		$championships = $this->teams->map(function ($team) {
			return ($team->position == 1) ? $team->season->year : null;
		})->toArray();

		return implode(array_filter($championships), ', ');
	}
}
