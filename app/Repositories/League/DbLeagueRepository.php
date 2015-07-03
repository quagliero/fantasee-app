<?php namespace Fantasee\Repositories\League;

use Fantasee\Repositories\DbRepository;
use Fantasee\League;

class DbLeagueRepository extends DbRepository implements LeagueRepository {

  /**
   * Constructor
   * @param League $model instance of Fantasee\League
   */
  function __construct(League $model)
  {
    $this->model = $model;
  }

  /**
   * getBySlug Get single league by unique slug
   * @param  string $slug
   * @return Fantasee\League
   */
  public function getBySlug($slug) {
    return $this->model->where('slug', $slug)->firstOrFail();
  }
}
