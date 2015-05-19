<?php namespace Fantasee\Commands;

use Fantasee\Commands\Command;
use Fantasee\League;
use Goutte\Client;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

abstract class ScrapeLeague extends Command implements SelfHandling, ShouldBeQueued {

	protected $league;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(League $league)
	{
    $this->client = new Client();
    $this->league = $league;
    $this->baseUrl = 'http://fantasy.nfl.com/league/' . $this->league->league_id . '/history';
	}

  /**
	 * Get a league's seasons
	 *
	 * @return array
	 */
  public function getSeasons()
  {
    if (count($this->league->seasons()) == 0) {
      $this->dispatch(new ScrapeSeasons, $this->league);
    }

    return $this->league->seasons();
  }

}
