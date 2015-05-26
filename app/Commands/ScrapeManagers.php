<?php namespace Fantasee\Commands;

use Fantasee\Manager;

class ScrapeManagers extends BaseScraper {

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

			$manager = $crawler->filter('#leagueOwners .tableWrap tbody tr')->each(function ($node) {
				$owner = $node->filter('.teamOwnerName')->text();
				$ownerId = preg_replace('/(\D)*/', '', $node->filter('[class*="userId-"]')->attr('class'));
				// The Dickens hack
				if ($ownerId == 2886224) {
					$ownerId = 6557238;
				}
				$manager = Manager::updateOrCreate([
					'name' => $owner,
					'league_id' => $this->league->id,
					'site_id' => $ownerId,
				]);
			});
		}
	}

}
