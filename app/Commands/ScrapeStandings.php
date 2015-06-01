<?php namespace Fantasee\Commands;

use Fantasee\Team;
use Fantasee\Manager;

class ScrapeStandings extends BaseScraper {

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
			$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/standings');

			$manager = $crawler->filter('#primaryContent #finalStandings #championResults .results ul > li')->each(function ($node, $i) use ($season) {
				// is it a customised standing?
				if ($node->filter('.customFinalTeam')->count()) {
					$name = $node->filter('.customFinalTeam')->text();
				} else {
					$name = $node->filter('.teamName')->text();
				}
				$pos = $i + 1;

				$team = Team::byLeague($this->league->id)->bySeason($season->id)->where('name', $name)->first();

				$team->position = $pos;
				$team->save();
			});
		}
	}

}
