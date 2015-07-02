<?php namespace Fantasee\Repositories\League;

interface LeagueRepository {

  /**
   * getAll Get All Leagues
   * @return Illuminate\Database\Collection
   */
  public function getAll();

  /**
   * getById Get single league by primary key
   * @param  integer $id
   * @return Fantasee\League
   */
  public function getById($id);

}
