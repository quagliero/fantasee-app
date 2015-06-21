<?php namespace Fantasee\Repositories;

abstract class DbRepository {

  protected $model;

  function __construct($model)
  {
    $this->model = $model;
  }

  public function getAll()
  {
    return $this->model->all();
  }

}
