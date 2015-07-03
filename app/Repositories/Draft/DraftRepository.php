<?php namespace Fantasee\Repositories\Draft;

interface DraftRepository {

  /**
   * getAll Get All Drafts
   * @return Illuminate\Database\Collection
   */
  public function getAll();

  /**
   * getById Get single draft by primary key
   * @param  integer $id
   * @return Fantasee\Draft
   */
  public function getById($id);

}
