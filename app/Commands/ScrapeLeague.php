<?php namespace Fantasee\Commands;

use Fantasee\League;

class ScrapeLeague extends BaseScraper {
	use \Illuminate\Foundation\Bus\DispatchesCommands;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($league)
	{
		// init base scrape constructor
		parent::__construct($league);
		// get the seasons
		$this->dispatch(new ScrapeSeasons($this->league));
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
		$this->dispatch(new ScrapeManagers($this->league));
		// event(new LeagueWasScraped($this->league));
	}

}
