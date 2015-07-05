<?php

use Fantasee\Repositories\Team\DbTeamRepository as Repo;
use Fantasee\Team;

class DbTeamRepositoryTest extends TestCase {

  public function testAbleToGetByLeagueAndSeasonId() {
    $repo = new Repo(new Team);
    $last = 0;
    $data = $repo->getByLeagueSeason(1, 1);

    foreach( $data as $team ) {
      $this->assertTrue( $team->position >= $last );
      $last = $team->position;
    }
  }
}
