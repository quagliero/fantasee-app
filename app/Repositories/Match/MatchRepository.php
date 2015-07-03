<?php namespace Fantasee\Repositories\Match;

interface MatchRepository {

  /**
   * getAll Get All Matchs
   * @return Illuminate\Database\Collection
   */
  public function getAll();

  /**
   * getById Get single match by primary key
   * @param  integer $id
   * @return Fantasee\Match
   */
  public function getById($id);

  /**
   * getByLeague Get all matches by league
   * @param  integer $leagueId
   * @return Illuminate\Database\Collection
   */
  public function getByLeague($leagueId);

  /**
   * getByLeague Get all matches by a league season
   * @param  integer $leagueId
   * @param  integer $seasonId
   * @return Illuminate\Database\Collection
   */
  public function getByLeagueSeason($leagueId, $seasonId);

  /**
   * getBySeasonManager Geta single match by a league season week
   * @param  integer $leagueId
   * @param  integer $seasonId
   * @param  integer $weekId
   * @return Fantasee\Match;
   */
  public function getByLeagueSeasonWeek($leagueId, $seasonId, $weekId);

}
