<?php namespace Fantasee\Commands;

use Fantasee\Season;

class ScrapeSeasons extends BaseScraper {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($league)
	{
		parent::__construct($league);
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		if (count($this->league->seasons()->get()) == 0) {
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

}
