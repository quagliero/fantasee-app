<?php namespace Fantasee\Repositories\Team;

use Fantasee\Repositories\DbRepository;
use Fantasee\Team;

class DbTeamRepository extends DbRepository implements TeamRepository {

  /**
   * Constructor
   * @param Team $model instance of Fantasee\Team
   */
  function __construct(Team $model)
  {
    $this->model = $model;
  }

  /**
   * getByLeague Get all teams by league
   * @param  integer $leagueId
   * @return Illuminate\Database\Collection
   */
  public function getByLeague($leagueId) {
    return $this->model->where('league_id', $leagueId)->get();
  }

  /**
   * getByLeague Get all teams by a league season
   * @param  integer $leagueId
   * @param  integer $seasonId
   * @return Illuminate\Database\Collection
   */
  public function getByLeagueSeason($leagueId, $seasonId) {
    return $this->model->where('league_id', $leagueId)
      ->where('season_id', $seasonId)->orderBy('position')->get();
  }

  /**
   * getBySeasonManager Geta single team by a season and manager
   * @param  integer $seasonId
   * @param  integer $managerId
   * @return Fantasee\Team;
   */
  public function getBySeasonManager($seasonId, $managerId) {
    return $this->model->where('season_id', $seasonId)
      ->where('manager_id', $managerId)->first();
  }

}
