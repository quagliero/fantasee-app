<?php namespace Fantasee\Repositories\Match;

use Fantasee\Repositories\DbRepository;
use Fantasee\Match;

class DbMatchRepository extends DbRepository implements MatchRepository {

  /**
   * Constructor
   * @param Match $model instance of Fantasee\Match
   */
  function __construct(Match $model)
  {
    $this->model = $model;
  }

  /**
   * getByLeague Get all matches by league
   * @param  integer $leagueId
   * @return Illuminate\Database\Collection
   */
  public function getByLeague($leagueId) {
    return $this->model->where('league_id', $leagueId)->get();
  }

  /**
   * getByLeague Get all matches by a league season
   * @param  integer $leagueId
   * @param  integer $seasonId
   * @return Illuminate\Database\Collection
   */
  public function getByLeagueSeason($leagueId, $seasonId) {
    return $this->model->where('league_id', $leagueId)
      ->where('season_id', $seasonId)
      ->orderBy('week_id')
      ->get();
  }

  /**
   * getBySeasonManager Get a single match by a league season week
   * @param  integer $leagueId
   * @param  integer $seasonId
   * @param  integer $weekId
   * @return Fantasee\Match;
   */
  public function getByLeagueSeasonWeek($leagueId, $seasonId, $weekId) {
    return $this->model->where('league_id', $leagueId)
      ->where('season_id', $seasonId)
      ->where('week_id', $weekId)
      ->get();
  }

}
