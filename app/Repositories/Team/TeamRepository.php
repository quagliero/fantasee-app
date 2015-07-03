<?php namespace Fantasee\Repositories\Team;

interface TeamRepository {

  /**
   * getAll Get All Teams
   * @return Illuminate\Database\Collection
   */
  public function getAll();

  /**
   * getById Get single team by primary key
   * @param  integer $id
   * @return Fantasee\Team
   */
  public function getById($id);

  /**
   * getByLeague Get all teams by league
   * @param  integer $leagueId
   * @return Illuminate\Database\Collection
   */
  public function getByLeague($leagueId);

  /**
   * getByLeague Get all teams by a league season
   * @param  integer $leagueId
   * @param  integer $seasonId
   * @return Illuminate\Database\Collection
   */
  public function getByLeagueSeason($leagueId, $seasonId);

  /**
   * getBySeasonManager Geta team by a season and manager
   * @param  integer $seasonId
   * @param  integer $managerId
   * @return Fantasee\Team;
   */
  public function getBySeasonManager($seasonId, $managerId);

}
