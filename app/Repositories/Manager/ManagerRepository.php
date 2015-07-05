<?php namespace Fantasee\Repositories\Manager;

interface ManagerRepository {

  /**
   * getAll Get All Drafts
   * @return Illuminate\Database\Collection
   */
  public function getAll();

  /**
   * getById Get single draft by primary key
   * @param  integer $id
   * @return Fantasee\Manager
   */
  public function getById($id);

}
