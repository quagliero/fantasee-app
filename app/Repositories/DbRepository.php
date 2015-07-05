<?php namespace Fantasee\Repositories;

abstract class DbRepository {

  /**
   * $model exposes Model to Repositories scope
   * @var Fantasee\Model
   */
  protected $model;

  /**
   * Constructor assigns Model instance
   * @param Fantasee\Model $model
   */
  function __construct($model)
  {
    $this->model = $model;
  }

  /**
   * getAll Return all results in the model's table
   * @return Illuminate\Database\Collection
   */
  public function getAll()
  {
    return $this->model->all();
  }

  /**
   * getById Return a Model instance by primary key
   * @param  integer $id
   * @return Fantasee\Model
   */
  public function getById($id)
  {
    return $this->model->find($id);
  }

  /**
   * count Returns the number of models in repo
   * @return integer
   */
  public function count() {
    return $this->model->all()->count();
  }

  public function random($num = 10) {
    if ($this->count() < $num) {
      return $this->getAll();
    }
    return $this->model->all()->random($num);
  }
}
