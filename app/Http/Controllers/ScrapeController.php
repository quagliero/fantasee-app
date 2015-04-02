<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;
use Fantasee\League;
use Fantasee\Season;
use Fantasee\Week;
use Fantasee\LeagueSeasonWeek;
use Fantasee\Manager;
use Fantasee\Team;
use Fantasee\Match;
use Illuminate\Http\Request;
use Goutte\Client;

class ScrapeController extends Controller {

	public function __construct(Request $request)
	{
		$this->client = new Client();
		$this->leagueId = $request->route('leagueId');
		$this->league = League::where('league_id', $this->leagueId)->firstOrFail();
		$this->baseUrl = 'http://fantasy.nfl.com/league/' . $this->league->league_id . '/history';
		$this->seasons = $this->scrapeSeasons();
	}

	private function scrapeSeasons()
	{
		$client = new Client();
		$crawler = $client->request('GET', $this->baseUrl);
		$seasons = $crawler->filter('#historySeasonNav .st-menu a[href]')->each(function ($node) {
			return Season::where('year', intval($node->text()))->first();
		});

		return $seasons;
	}

	private function createLeagueSeasons()
	{
		$seasonIds = array_map(function ($s) {
			return $s->id;
		}, $this->seasons);

		$this->league->seasons()->sync($seasonIds);
	}


	private function createLeagueManagers()
	{
		foreach ($this->seasons as $season) {
			$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/owners');

			$manager = $crawler->filter('#leagueOwners .tableWrap tbody tr')->each(function ($node) {
				$owner = $node->filter('.teamOwnerName')->text();
				$ownerId = preg_replace('/(\D)*/', '', $node->filter('[class*="userId-"]')->attr('class'));
				$manager = Manager::updateOrCreate([
					'name' => $owner,
					'league_id' => $this->league->id,
					'site_id' => $ownerId,
				]);

			});
		}
	}

	private function createLeagueTeams()
	{
		foreach ($this->seasons as $season) {
			$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/owners');

			$manager = $crawler->filter('#leagueOwners .tableWrap tbody tr')->each(function ($node) use ($season) {
				$managerId = preg_replace('/(\D)*/', '', $node->filter('[class*="userId-"]')->attr('class'));
				$name = $node->filter('.teamName')->text();
				// The Dickens hack
				if ($managerId == 2886224) {
					$managerId = 6557238;
				}
				$manager = Manager::where('site_id', $managerId)->first();
				$team = Team::updateOrCreate([
					'name' => $name,
					'league_id' => $this->league->id,
					'manager_id' => $manager->id,
					'season_id' => $season->id,
				]);
			});
		}
	}

	/*
	 * ScraperController@createLeagueSchedule
	 * $seasons Array - array of Season models
	 * $pagination String - the additional URL params to navigate individual weeks
	 */
	private function createLeagueSchedule($seasons, $pagination = '')
	{
		$urlParams = $pagination ?: 'schedule?leagueId=' . $this->league->league_id . '&scheduleDetail=1&scheduleType=week&standingsTab=schedule';

		foreach ($seasons as $season) {
			$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/' . $urlParams);

			$week = Week::where('id', intval($crawler->filter('#scheduleSchedule .content ul.scheduleWeekNav .selected .title span')->text()))->first();

			$matchups = $crawler->filter('#scheduleSchedule .content .scheduleContent .matchups .matchup');
			$matchups->each(function ($node) use ($season, $week) {
				$team1 = $this->buildTeam($node, 1);
				$team2 = $this->buildTeam($node, 2);
				// The Dickens hack
				if ($team1->manager_id == 2886224) {
					$team1->manager_id = 6557238;
				}
				// The Dickens hack
				if ($team2->manager_id == 2886224) {
					$team2->manager_id = 6557238;
				}
				$manager1 = Manager::where('site_id', $team1->manager_id)->first();
				$manager2 = Manager::where('site_id', $team2->manager_id)->first();
				$team1Model = Team::byLeague($this->league->id)->bySeason($season->id)->byManager($manager1->id)->first();
				$team2Model = Team::byLeague($this->league->id)->bySeason($season->id)->byManager($manager2->id)->first();

				$match = Match::updateOrCreate([
					'league_id' => $this->league->id,
					'season_id' => $season->id,
					'week_id' => $week->id,
					'team1_id' => $team1Model->id,
					'team1_score' => $team1->score,
					'team2_id' => $team2Model->id,
					'team2_score' => $team2->score,
				]);

			});

			// Create League Season Week pivot
			$leagueSeasonWeek = LeagueSeasonWeek::firstOrCreate([
				'league_id' => $this->league->id,
				'season_id' => $season->id,
				'week_id' => $week->id
			]);

			// we have a next week, recursion!
			if ($crawler->filter('#scheduleSchedule .weekNav .ww-next a')->count()) {
				$next = $crawler->filter('#scheduleSchedule .weekNav .ww-next a')->attr('href');
				$this->createLeagueSchedule(array($season), $next);
			}
		}
	}

	private function buildTeam($matchup, $team) {
	  $team = $matchup->filter('.teamWrap-' . $team);
	  return (object) array(
			'manager_id' => preg_replace('/(\D)*/', '', $team->filter('[class*="userId-"]')->attr('class')),
	    'name' => $team->filter('.teamName')->text(),
	    'score' => $team->filter('.teamTotal')->text()
	  );
	}

	public function index(Request $request) {

		$this->createLeagueSeasons();
		$this->createLeagueManagers();
		$this->createLeagueTeams();
		$this->createLeagueSchedule($this->seasons);

		//
		// // display season champs
		// $seasons = [2012, 2013, 2014];
		//
		// $crawler->filter('#leagueHistoryAlmanac [class*="history-champ"]')->each(function ($node) {
		// 	$year = $node->filter('.historySeason')->text();
		// 	$team = $node->filter('.historyTeam .teamName')->text();
		//
		// 	print $year . ' Champion: ' . $team . '<br>';
		// });
		//
		// print '<br>';
		//
		// // display season best week score
		// $crawler->filter('#leagueHistoryAlmanac [class*="history-btw"]')->each(function ($node) {
		// 	$row = $node;
		// 	$year = $row->filter('.historySeason')->text();
		// 	$week = $row->filter('.historyWeek')->text();
		// 	$team = $row->filter('.historyTeam .teamName')->text();
		// 	$points = $row->filter('.historyPts')->text();
		//
		// 	print $year . ' Weekly Points Winner: ' . $team . ' with ' . $points . ' points in week ' . $week . '<br>';
		// });
		//
		// print '<br>';
		//
		// // display best player week score
		// $crawler->filter('#leagueHistoryAlmanac [class*="history-bpw"]')->each(function ($node) {
		// 	$row = $node;
		// 	$year = $row->filter('.historySeason')->text();
		// 	$week = $row->filter('.historyWeek')->text();
		// 	$team = $row->filter('.historyTeam .teamName')->text();
		// 	$player = $row->filter('.playerNameAndInfo .playerName')->text();
		// 	$posTeam = $row->filter('.playerNameAndInfo em')->text();
		// 	$points = $row->filter('.historyPts')->text();
		// 	print $year . ' Weekly Player Points Winner: ' . $team . ' with ' . $player . ' (' . $posTeam . ') with ' . $points . ' points in week ' . $week . '<br>';
		// });
		//
		// print '<br>';
		//
		// // display team season high points
		// $crawler->filter('#leagueHistoryAlmanac [class*="history-bts"]')->each(function ($node) {
		// 	$row = $node;
		// 	$year = $row->filter('.historySeason')->text();
		// 	$team = $row->filter('.historyTeam .teamName')->text();
		// 	$points = $row->filter('.historyPts')->text();
		//
		// 	print $year . ' Season Points Winner: ' . $team . ' with ' . $points . ' points<br>';
		// });
		//
		// print '<br>';
		//
		// // season managers
		// foreach ($seasons as $season) {
		// 	print '<h3>Season ' . $season . ' Managers</h3>';
		// 	$crawler = $client->request('GET', 'http://fantasy.nfl.com/league/' . $leagueId . '/history/' . $season . '/owners');
		// 	$crawler->filter('#leagueOwners .tableWrap tbody tr')->each(function ($node) {
		// 		$owner = $node->filter('.teamOwnerName')->text();
		// 		$ownerId = preg_replace('/(\D)*/', '', $node->filter('[class*="userId-"]')->attr('class'));
		// 		$ownerTeamName = $node->filter('.teamName')->text();
		// 		print $owner . ' (' . $ownerId . ') : ' . $ownerTeamName . '<br>';
		// 	});
		// }
		//
		// print '<br>';
		//
		// // season standings
		//
		// foreach ($seasons as $season) {
		// 	print '<h2>' . $season . '</h2>';
		// 	$crawler = $client->request('GET', 'http://fantasy.nfl.com/league/' . $leagueId . '/history/' . $season . '/standings');
		// 	$crawler->filter('#finalStandings #championResults .results li')->each(function ($node, $i) {
		// 		$pos = $i += 1;
		// 		$team = $node->filter('.teamName')->text();
		// 		print $pos . ' : ' . $team . '<br>';
		// 	});
		// }
		//
		// // draft results
		// foreach ($seasons as $season) {
		// 	$crawler = $client->request('GET', 'http://fantasy.nfl.com/league/' . $leagueId . '/history/' . $season . '/draftresults?draftResultsDetail=0&draftResultsTab=round&draftResultsType=results');
		// 	print '<h2>' . $season . ' Draft</h2>';
		// 	$crawler->filter('#leagueDraftResults #leagueDraftResultsResults .results .wrap > ul')->each(function ($round, $i) {
		// 		print '<h3>Round ' . ($i + 1) . '</h3>';
		// 		$round->children('li')->each(function ($pick) {
    //       $num = $pick->filter('.count')->text();
    //       $player = $pick->filter('.playerName')->text();
    //       $team = $pick->filter('.teamName')->text();
    //       print 'Pick ' . $num . ': ' . $player . ' TO ' . $team . '<br>';
    //     });
		// 	});
		// }

	}

}
