<?php namespace Fantasee\Commands;

use Fantasee\Draft;

class ScrapeDraft extends BaseScraper {

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
			$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/draftresults?draftResultsDetail=0&draftResultsTab=round&draftResultsType=results');

			if ($crawler) {
				$seasonDraft = Draft::updateOrCreate([
					'league_id' => $this->league->id,
					'season_id' => $season->id,
				]);
			}
			//
			// $rounds = $crawler->filter('#leagueDraftResults #leagueDraftResultsResults .results .wrap > ul');
			//
			// $rounds->each(function ($round, $i) use ($season) {
			// 	$round->children('li')->each(function ($pick, $j) use ($season, $i) {
			// 		$roundNumber = $i + 1;
		  //     $pickNumber = preg_replace('/(\D)*/', '', $pick->filter('.count')->text());
		  //     $player = $pick->filter('.playerName')->text();
		  //     $teamName = $pick->filter('.teamName')->text();
			// 		$team = Team::byLeague($this->league->id)->bySeason($season->id)->where('name', $teamName)->first();
		  //   });
			// });
		}
	}

}
