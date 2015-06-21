<?php namespace Fantasee\Repositories\League;

use Fantasee\Repositories\DbRepository;
use Fantasee\League;

class DbLeagueRepository extends DbRepository implements LeagueRepository {

  /**
   * @var League
   */
  function __construct(League $model)
  {
    $this->model = $model;
  }

}
