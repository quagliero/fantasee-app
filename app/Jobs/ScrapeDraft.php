<?php namespace Fantasee\Jobs;

use Fantasee\Draft;
use Fantasee\Team;
use Fantasee\Player;
use Fantasee\Pick;

class ScrapeDraft extends BaseScraper {

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
			$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/draftresults?draftResultsDetail=0&draftResultsTab=round&draftResultsType=results');

			if ($crawler) {
				$season_draft = Draft::firstOrCreate([
					'league_id' => $this->league->id,
					'season_id' => $season->id,
				]);
			}
			$rounds = $crawler->filter('#leagueDraftResults #leagueDraftResultsResults .results .wrap > ul');

			$rounds->each(function ($round, $i) use ($season, $season_draft) {
				$round->children('li')->each(function ($pick, $j) use ($season, $season_draft, $i) {
					$round_number = $i + 1;
		      $pick_number = preg_replace('/(\D)*/', '', $pick->filter('.count')->text());
					$player_info = (object) array(
						'id' => preg_replace('/(\D)*/', '', $pick->filter('[class*="playerNameId-"]')->attr('class')),
						'name' => $pick->filter('.playerName')->text(),
						'position' => explode(' - ', $pick->filter('.playerName + em')->text())[0]
					);

		      $team_name = $pick->filter('.teamName')->text();
					$team = Team::byLeague($this->league->id)->bySeason($season->id)->where('name', $team_name)->first();

					// Create or update this NFL player
					$player = Player::firstOrNew(['site_id' => $player_info->id]);
					if ($player->name !== $player_info->name) {
						$player->name = $player_info->name;
					}
					if ($player->position !== $player_info->position) {
						$player->position = $player_info->position;
					}
					$player->save();

					// Add the pick
					$pick = Pick::firstOrCreate([
						'draft_id' => $season_draft->id,
						'team_id' => $team->id,
						'player_id' => $player->id,
						'round' => $round_number,
						'pick' => $pick_number
					]);
		    });
			});
		}
	}

}
