<?php namespace Fantasee\Jobs;

use Fantasee\Jobs\Job;
use Fantasee\League;
use Goutte\Client;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class BaseScraper extends Job implements SelfHandling, ShouldQueue {

	protected $league, $client, $baseUrl;

	/**
	 * Create a new Job instance.
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
