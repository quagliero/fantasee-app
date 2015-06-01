<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;
use Fantasee\Commands\ScrapeSeasons;
use Fantasee\Commands\ScrapeManagers;
use Fantasee\Commands\ScrapeTeams;
use Fantasee\Commands\ScrapeStandings;
use Fantasee\Commands\ScrapeSchedule;
use Fantasee\League;
use Illuminate\Http\Request;
use Goutte\Client;

class ScrapeController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
	}

	public function store(Request $request, League $league) {
		// map input keys to their corresponding scraper
		$availableCommands = [
			'seasons' => ScrapeSeasons::class,
			'managers' => ScrapeManagers::class,
			'teams' => ScrapeTeams::class,
			'standings' => ScrapeStandings::class,
			'schedule' => ScrapeSchedule::class,
			'draft' => ScrapeDraft::class
		];
		// grab the posted keys and compare with available options
		$selectedCommands = array_intersect_key($availableCommands, $request->all());

		foreach ($selectedCommands as $key => $value)
		{
			$this->dispatch(new $availableCommands[$key]($league));
		}
		// once finished, redirect back to league edit view
		return redirect()->route('league_path', [$league->slug]);
	}

	//
	// private function createLeagueDrafts()
	// {
	// 	// draft results
	// 	foreach ($this->seasons as $season) {
	// 		$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/draftresults?draftResultsDetail=0&draftResultsTab=round&draftResultsType=results');
	//
	// 		$rounds = $crawler->filter('#leagueDraftResults #leagueDraftResultsResults .results .wrap > ul');
	//
	// 		$rounds->each(function ($round, $i) use ($season) {
	// 			$round->children('li')->each(function ($pick, $j) use ($season, $i) {
	// 				$roundNumber = $i + 1;
	// 	      $pickNumber = preg_replace('/(\D)*/', '', $pick->filter('.count')->text());
	// 	      $player = $pick->filter('.playerName')->text();
	// 	      $teamName = $pick->filter('.teamName')->text();
	// 				$team = Team::byLeague($this->league->id)->bySeason($season->id)->where('name', $teamName)->first();
	// 				$draftPick = Draft::updateOrCreate([
	// 					'league_id' => $this->league->id,
	// 					'season_id' => $season->id,
	// 					'round_id' => $roundNumber,
	// 					'pick' => $pickNumber,
	// 					'team_id' => $team->id,
	// 					// 'player_id' => $player,
	// 				]);
	// 	    });
	// 		});
	// 	}
	// }
	//

}
