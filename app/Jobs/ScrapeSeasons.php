<?php namespace Fantasee\Jobs;

use Fantasee\Season;

class ScrapeSeasons extends BaseScraper {

	/**
	 * Create a new Job instance.
	 *
	 * @return void
	 */
	public function __construct($league)
	{
		parent::__construct($league);
	}

	/**
	 * Execute the Job.
	 *
	 * @return void
	 */
	public function handle()
	{
			$crawler = $this->client->request('GET', $this->baseUrl);
			$seasons = $crawler->filter('#historySeasonNav .st-menu a[href]')->each(function ($node) {
				return Season::where('year', intval($node->text()))->first();
			});

			$seasonIds = array_map(function ($s) {
				return $s->id;
			}, $seasons);

			$this->league->seasons()->sync($seasonIds);
		}
}
