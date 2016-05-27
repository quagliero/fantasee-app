<?php namespace Fantasee\Repositories\Trade;

interface TradeRepository {

  /**
   * getAll Get All Trades
   * @return Illuminate\Database\Collection
   */
  public function getAll();

  /**
   * getById Get single trade by primary key
   * @param  integer $id
   * @return Fantasee\Trade
   */
  public function getById($id);

  /**
   * getByLeague Get all trades by league
   * @param  integer $leagueId
   * @return Illuminate\Database\Collection
   */
  public function getByLeague($leagueId);

  /**
   * getByLeague Get all trades by a league season
   * @param  integer $leagueId
   * @param  integer $seasonId
   * @return Illuminate\Database\Collection
   */
  public function getByLeagueSeason($leagueId, $seasonId);

}
