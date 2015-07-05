<?php namespace Fantasee\Repositories\Manager;

use Fantasee\Repositories\DbRepository;
use Fantasee\Manager;

class DbManagerRepository extends DbRepository implements ManagerRepository {

  /**
   * Constructor
   * @param Manager $model instance of Fantasee\Manager
   */
  function __construct(Manager $model)
  {
    $this->model = $model;
  }
}
