<?php namespace Fantasee\Repositories\Draft;

use Fantasee\Repositories\DbRepository;
use Fantasee\Draft;

class DbDraftRepository extends DbRepository implements DraftRepository {

  /**
   * Constructor
   * @param Draft $model instance of Fantasee\Draft
   */
  function __construct(Draft $model)
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
    $data = $this->model
      ->where('league_id', $leagueId)
      ->where('season_id', $seasonId)
    ->get();

    return $this->prepareData($data);
  }

}
