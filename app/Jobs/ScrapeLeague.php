<?php namespace Fantasee\Jobs;

class ScrapeLeague extends BaseScraper {
	use \Illuminate\Foundation\Bus\DispatchesJobs;

	/**
	 * Create a new Job instance.
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
	 * Execute the Job.
	 *
	 * @return void
	 */
	public function handle()
	{
		// Handle the scrape
		// dispatch Jobs for a whole league scrape
		$this->dispatch(new ScrapeManagers($this->league));
		$this->dispatch(new ScrapeTeams($this->league));
		$this->dispatch(new ScrapeStandings($this->league));
		$this->dispatch(new ScrapeSchedule($this->league));
		$this->dispatch(new ScrapeDraft($this->league));
		$this->dispatch(new ScrapeTrades($this->league));

		// event(new LeagueWasScraped($this->league));
	}

}
