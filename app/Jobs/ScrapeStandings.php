<?php namespace Fantasee\Jobs;

use Fantasee\Team;
use Fantasee\Manager;

class ScrapeStandings extends BaseScraper {

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
		foreach ($this->league->seasons as $season) {
			$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/standings');

			$crawler->filter('#primaryContent #finalStandings #championResults .results ul > li')->each(function ($node, $i) use ($season) {
				// is it a customised standing?
				if ($node->filter('.customFinalTeam')->count()) {
					$name = $node->filter('.customFinalTeam')->text();
				} else {
					$name = $node->filter('.teamName')->text();
				}
				$pos = $i + 1;

				$team = Team::byLeague($this->league->id)->bySeason($season->id)->where('name', $name)->first();
				// create placeholder manager and team if it's an archived team
				if ($team === null) {
					$manager = Manager::create([
						'league_id' => $this->league->id,
						'name' => 'Manager of ' . $name,
						'site_id' => 0
					]);

					$team = Team::create([
						'league_id' => $this->league->id,
						'season_id' => $season->id,
						'name' => $name,
						'manager_id' => $manager->id,
						'position' => $pos
					]);
				} else {
					$team->position = $pos;
					$team->save();
				}

			});
		}
	}

}
