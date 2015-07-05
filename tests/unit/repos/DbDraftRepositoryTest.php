<?php

use Fantasee\Repositories\Draft\DbDraftRepository as Repo;
use Fantasee\Draft;

class DbDraftRepositoryTest extends TestCase {

  public function testAbleToGetByLeagueAndSeasonId() {
    $repo = new Repo(new Draft);

    $data = $repo->getByLeagueSeason(1, 1);

    foreach( $data as $draft ) {
      $this->assertEquals($draft->season_id, 1);
      $this->assertEquals($draft->league_id, 1);
    }
  }
}
