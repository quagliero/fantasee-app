<?php namespace Fantasee\Commands;

use Fantasee\Commands\Command;
use Fantasee\League;
use Goutte\Client;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

abstract class BaseScraper extends Command implements SelfHandling, ShouldBeQueued {

	protected $league, $client, $baseUrl;

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

}
