<?php namespace Fantasee\Commands;

use Fantasee\Team;
use Fantasee\Manager;

class ScrapeTeams extends BaseScraper {

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
		foreach ($this->league->seasons as $season) {
			$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/owners');

			$manager = $crawler->filter('#leagueOwners .tableWrap tbody tr')->each(function ($node) use ($season) {
				$managerId = preg_replace('/(\D)*/', '', $node->filter('[class*="userId-"]')->attr('class'));
				$name = $node->filter('.teamName')->text();
				// The Dickens hack
				if ($managerId == 2886224) {
					$managerId = 6557238;
				}
				$manager = Manager::byLeague($this->league->id)->where('site_id', $managerId)->first();
				$team = Team::updateOrCreate([
					'name' => $name,
					'league_id' => $this->league->id,
					'manager_id' => $manager->id,
					'season_id' => $season->id,
				]);
			});
		}
	}

}
