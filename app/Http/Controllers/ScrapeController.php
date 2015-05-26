<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;
use Fantasee\Commands\ScrapeSeasons;
use Fantasee\Commands\ScrapeManagers;
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
	// private function createLeagueTeams()
	// {
	// 	foreach ($this->seasons as $season) {
	// 		$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/owners');
	//
	// 		$manager = $crawler->filter('#leagueOwners .tableWrap tbody tr')->each(function ($node) use ($season) {
	// 			$managerId = preg_replace('/(\D)*/', '', $node->filter('[class*="userId-"]')->attr('class'));
	// 			$name = $node->filter('.teamName')->text();
	// 			// The Dickens hack
	// 			if ($managerId == 2886224) {
	// 				$managerId = 6557238;
	// 			}
	// 			$manager = Manager::byLeague($this->league->id)->where('site_id', $managerId)->first();
	// 			$team = Team::updateOrCreate([
	// 				'name' => $name,
	// 				'league_id' => $this->league->id,
	// 				'manager_id' => $manager->id,
	// 				'season_id' => $season->id,
	// 			]);
	// 		});
	// 	}
	//
	// 	// After we have the teams, go and grab their standings
	// 	$this->createLeagueStandings();
	// }
	//
	// private function createLeagueStandings()
	// {
	// 	foreach ($this->seasons as $season) {
	// 		$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/standings');
	//
	// 		$manager = $crawler->filter('#primaryContent #finalStandings #championResults .results ul > li')->each(function ($node, $i) use ($season) {
	// 			// is it a customised standing?
	// 			if ($node->filter('.customFinalTeam')->count()) {
	// 				$name = $node->filter('.customFinalTeam')->text();
	// 			} else {
	// 				$name = $node->filter('.teamName')->text();
	// 			}
	// 			$pos = $i + 1;
	//
	// 			$team = Team::byLeague($this->league->id)->bySeason($season->id)->where('name', $name)->first();
	//
	// 			$team->position = $pos;
	// 			$team->save();
	// 		});
	// 	}
	// }
	//
	// /*
	//  * ScraperController@createLeagueSchedule
	//  * $seasons Array - array of Season models
	//  * $pagination String - the additional URL params to navigate individual weeks
	//  */
	// private function createLeagueSchedule($seasons, $pagination = '')
	// {
	// 	$urlParams = $pagination ?: 'schedule?leagueId=' . $this->league->league_id . '&scheduleDetail=1&scheduleType=week&standingsTab=schedule';
	//
	// 	foreach ($seasons as $season) {
	// 		$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/' . $urlParams);
	//
	// 		$week = Week::where('id', intval($crawler->filter('#scheduleSchedule .content ul.scheduleWeekNav .selected .title span')->text()))->first();
	//
	// 		$matchups = $crawler->filter('#scheduleSchedule .content .scheduleContent .matchups .matchup');
	// 		$matchups->each(function ($node) use ($season, $week) {
	// 			$team1 = $this->buildTeam($node, 1);
	// 			$team2 = $this->buildTeam($node, 2);
	// 			// The Dickens hack
	// 			if ($team1->manager_id == 2886224) {
	// 				$team1->manager_id = 6557238;
	// 			}
	// 			// The Dickens hack
	// 			if ($team2->manager_id == 2886224) {
	// 				$team2->manager_id = 6557238;
	// 			}
	// 			$manager1 = Manager::byLeague($this->league->id)->where('site_id', $team1->manager_id)->first();
	// 			$manager2 = Manager::byLeague($this->league->id)->where('site_id', $team2->manager_id)->first();
	// 			$team1Model = Team::byLeague($this->league->id)->bySeason($season->id)->byManager($manager1->id)->first();
	// 			$team2Model = Team::byLeague($this->league->id)->bySeason($season->id)->byManager($manager2->id)->first();
	//
	// 			$match = Match::updateOrCreate([
	// 				'league_id' => $this->league->id,
	// 				'season_id' => $season->id,
	// 				'week_id' => $week->id,
	// 				'team1_id' => $team1Model->id,
	// 				'team1_score' => $team1->score,
	// 				'team2_id' => $team2Model->id,
	// 				'team2_score' => $team2->score,
	// 			]);
	//
	// 		});
	//
	// 		// Create League Season Week pivot
	// 		$leagueSeasonWeek = LeagueSeasonWeek::firstOrCreate([
	// 			'league_id' => $this->league->id,
	// 			'season_id' => $season->id,
	// 			'week_id' => $week->id
	// 		]);
	//
	// 		// we have a next week, recursion!
	// 		if ($crawler->filter('#scheduleSchedule .weekNav .ww-next a')->count()) {
	// 			$next = $crawler->filter('#scheduleSchedule .weekNav .ww-next a')->attr('href');
	// 			$this->createLeagueSchedule(array($season), $next);
	// 		}
	// 	}
	// }
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
	// private function buildTeam($matchup, $team) {
	//   $team = $matchup->filter('.teamWrap-' . $team);
	//   return (object) array(
	// 		'manager_id' => preg_replace('/(\D)*/', '', $team->filter('[class*="userId-"]')->attr('class')),
	//     'name' => $team->filter('.teamName')->text(),
	//     'score' => $team->filter('.teamTotal')->text()
	//   );
	// }
}
