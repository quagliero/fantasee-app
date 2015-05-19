<?php namespace Fantasee\Commands;

use Fantasee\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class ScrapeLeague extends Command implements SelfHandling, ShouldBeQueued {

	protected $league, $request;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(League $league, $data)
	{
		$this->league = $league;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		// Handle the scrape
		// dispatch Commands for a whole league scrape


		event(new LeagueWasScraped($this->league));
	}

}
