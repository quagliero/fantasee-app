<?php namespace Fantasee\Repositories\Manager;

interface ManagerRepository {

  /**
   * getAll Get All Managers
   * @return Illuminate\Database\Collection
   */
  public function getAll();

  /**
   * getById Get single manager by primary key
   * @param  integer $id
   * @return Fantasee\Manager
   */
  public function getById($id);

}
