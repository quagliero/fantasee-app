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
    return $this->prepareData($this->model->all());
  }

  /**
   * getById Return a Model instance by primary key
   * @param  integer $id
   * @return Fantasee\Model
   */
  public function getById($id)
  {
    return $this->prepareData($this->model->find($id));
  }

  /**
   * prepareData Prepares found collection for return
   * @param  Illuminate\Database\Eloquent\Collection $input   Found models
   * @param  Array $options
   * @return Illuminate\Database\Eloquent\Collection
   */
  protected function prepareData($input, $options = []) {
    $return = $input;

    if (empty($options)) {
      return $return;
    }

    if (array_key_exists('sort', $options)) {
      $opts = $options['sort'];

      $return = $this->sortData($return, $opts['order'], $opts['key']);
    }

    return $return;
  }

  /**
   * sortData Generic sorting alogrithm
   * @param  Illuminate\Database\Eloquent\Collection $data
   * @param  string $order
   * @param  string $key
   * @return Illuminate\Database\Eloquent\Collection
   */
  protected function sortData($data, $order = 'desc', $key = 'id') {
    $data = $data->sort(function ($a, $b) use ($key) {
      if ($a->{$key} == $b->{$key}) {
        return 0;
      }

      return $a->{$key} < $b->{$key} ? 1 : -1;
    });

    if ($order == 'asc') {
      return $data->reverse();
    }

    return $data;
  }

  /**
   * count Returns the number of models in repo
   * @return integer
   */
  public function count() {
    return $this->model->all()->count();
  }

  /**
   * random Return a random number of models from a collection
   * @param  integer $num
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function random($num = 10) {
    if ($this->count() < $num) {
      return $this->getAll();
    }
    return $this->model->all()->random($num);
  }
}
