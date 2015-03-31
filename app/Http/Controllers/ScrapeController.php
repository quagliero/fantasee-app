<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Goutte\Client;

class ScrapeController extends Controller {

	public function index(Request $request) {
		$client = new Client();
		$leagueId = $request->route('leagueId');

		$crawler = $client->request('GET', 'http://fantasy.nfl.com/league/' . $leagueId . '/history');

		// Get the latest post in this category and display the titles
		$crawler->filter('#historySeasonNav .st-menu a[href]')->each(function ($node) {
			print $node->text()."<br>";
		});

		print '<br>';

		// display season champs
		$seasons = [];

		$crawler->filter('#leagueHistoryAlmanac [class*="history-champ"]')->each(function ($node) {
			$year = $node->filter('.historySeason')->text();
			$team = $node->filter('.historyTeam .teamName')->text();

			print $year . ' Champion: ' . $team . '<br>';
		});

		print '<br>';

		// display season best week score
		$crawler->filter('#leagueHistoryAlmanac [class*="history-btw"]')->each(function ($node) {
			$row = $node;
			$year = $row->filter('.historySeason')->text();
			$week = $row->filter('.historyWeek')->text();
			$team = $row->filter('.historyTeam .teamName')->text();
			$points = $row->filter('.historyPts')->text();

			print $year . ' Weekly Points Winner: ' . $team . ' with ' . $points . ' points in week ' . $week . '<br>';
		});

		print '<br>';

		// display best player week score
		$crawler->filter('#leagueHistoryAlmanac [class*="history-bpw"]')->each(function ($node) {
			$row = $node;
			$year = $row->filter('.historySeason')->text();
			$week = $row->filter('.historyWeek')->text();
			$team = $row->filter('.historyTeam .teamName')->text();
			$player = $row->filter('.playerNameAndInfo .playerName')->text();
			$posTeam = $row->filter('.playerNameAndInfo em')->text();
			$points = $row->filter('.historyPts')->text();
			print $year . ' Weekly Player Points Winner: ' . $team . ' with ' . $player . ' (' . $posTeam . ') with ' . $points . ' points in week ' . $week . '<br>';
		});

		print '<br>';

		// display team season high points
		$crawler->filter('#leagueHistoryAlmanac [class*="history-bts"]')->each(function ($node) {
			$row = $node;
			$year = $row->filter('.historySeason')->text();
			$team = $row->filter('.historyTeam .teamName')->text();
			$points = $row->filter('.historyPts')->text();

			print $year . ' Season Points Winner: ' . $team . ' with ' . $points . ' points<br>';
		});

		print '<br>';

		// season standings
		$seasons = [2012, 2013, 2014];
		foreach ($seasons as $season) {
			print '<h2>' . $season . '</h2>';
			$crawler = $client->request('GET', 'http://fantasy.nfl.com/league/' . $leagueId . '/history/' . $season . '/standings');
			$crawler->filter('#finalStandings #championResults .results li')->each(function ($node, $i) {
				$pos = $i += 1;
				$team = $node->filter('.teamName')->text();
				print $pos . ' : ' . $team . '<br>';
			});
		}

		foreach ($seasons as $season) {
			$crawler = $client->request('GET', 'http://fantasy.nfl.com/league/' . $leagueId . '/history/' . $season . '/draftresults?draftResultsDetail=0&draftResultsTab=round&draftResultsType=results');
			print '<h2>' . $season . ' Draft</h2>';
			$crawler->filter('#leagueDraftResults #leagueDraftResultsResults .results .wrap > ul')->each(function ($round, $i) {
				print '<h3>Round ' . ($i + 1) . '</h3>';
				$round->children('li')->each(function ($pick) {
          $num = $pick->filter('.count')->text();
          $player = $pick->filter('.playerName')->text();
          $team = $pick->filter('.teamName')->text();
          print 'Pick ' . $num . ': ' . $player . ' TO ' . $team . '<br>';
        });
			});
		}


	}
}
