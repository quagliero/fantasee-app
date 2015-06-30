<?php namespace Fantasee;

use Fantasee\Traits\HasFantasyPoints;
use Fantasee\Traits\HasPerformanceRecord;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model {

	use HasFantasyPoints;
	use HasPerformanceRecord;

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
	public function getWinsAttribute()
	{
		return $this->teams->reduce(function ($wins, $team) {
			return $wins += $team->wins;
		});
	}

	/**
	 * Get manager losses
	 *
	 * @var number
	 */
	public function getLossesAttribute()
	{
		return $this->teams->reduce(function ($losses, $team) {
			return $losses += $team->losses;
		});
	}

	/**
	 * Get manager losses
	 *
	 * @var number
	 */
	public function getTiesAttribute()
	{
		return $this->teams->reduce(function ($ties, $team) {
			return $ties += $team->ties;
		});
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

		return number_format((float)$totalPointsFor, 2, '.', '');
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

		return number_format((float)$totalPointsAgainst, 2, '.', '');
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

	/**
	 * Get manager win percentage
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
