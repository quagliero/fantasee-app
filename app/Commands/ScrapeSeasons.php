<?php namespace Fantasee\Commands;

use Fantasee\Commands\BaseScraper;
use Fantasee\Season;

class ScrapeSeasons extends BaseScraper {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(League $league)
	{
		//
	}

	/**
	 * Execute the command.
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
