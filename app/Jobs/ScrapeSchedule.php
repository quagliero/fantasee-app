<?php namespace Fantasee\Jobs;

use Fantasee\Team;
use Fantasee\Manager;
use Fantasee\Week;
use Fantasee\Match;
use Fantasee\LeagueSeasonWeek;

class ScrapeSchedule extends BaseScraper {

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
		$this->scrapeSchedule($this->league->seasons);
	}

	/**
	 * scrapeSchedule
	 * $seasons Array - array of Season models
	 * $pagination String - the additional URL params to navigate individual weeks
	 */
	private function scrapeSchedule($seasons, $pagination = '') {
		$urlParams = $pagination ?: 'schedule?leagueId=' . $this->league->league_id . '&scheduleDetail=1&scheduleType=week&standingsTab=schedule';

		foreach ($seasons as $season) {
			$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/' . $urlParams);

			$week = Week::where('id', intval($crawler->filter('#scheduleSchedule .content ul.scheduleWeekNav .selected a[href]')->text()))->first();

			$matchups = $crawler->filter('#scheduleSchedule .content .scheduleContent .matchups .matchup');
			$matchups->each(function ($node) use ($season, $week) {
				$team1 = $this->getTeamScoreFromMatchup($season, $node, 1);
				$team2 = $this->getTeamScoreFromMatchup($season, $node, 2);

				$match = Match::updateOrCreate([
					'league_id' => $this->league->id,
					'season_id' => $season->id,
					'week_id' => $week->id,
					'team1_id' => $team1->id,
					'team1_score' => $team1->score,
					'team2_id' => $team2->id,
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
				$this->scrapeSchedule(array($season), $next);
			}
		}
	}

	/*
	 * Build a team match info assoc array from a matchup
	 * $season Model - The season of the matchup
	 * $matchup DOMNode - Contains the two teams and scores
	 * $team Integer - Either 1 or 2
	 */
	private function getTeamScoreFromMatchup($season, $matchup, $team) {
	  $teamInfo = $matchup->filter('.teamWrap-' . $team);
		$score = $teamInfo->filter('.teamTotal')->text();

		// we have a user attached to this team
		if ($teamInfo->filter('[class*="userId-"]')->count()) {
			$manager_id = preg_replace('/(\D)*/', '', $teamInfo->filter('[class*="userId-"]')->attr('class'));

			// The Dickens hack (changed user accounts after one season)
			if ($manager_id == 2886224) {
				$manager_id = 6557238;
			}

			$manager = Manager::byLeague($this->league->id)->where('site_id', $manager_id)->first();
			$team = Team::byLeague($this->league->id)
				->bySeason($season->id)
				->byManager($manager->id)
				->first();
		} else {
			// no use attached to the team so try and query from existing matching name or create
			$team =	Team::byLeague($this->league->id)
				->bySeason($season->id)
				->where('name', $teamInfo->filter('.teamName')->text())
				->firstOrFail();
		}

	  return (object) array(
			'id' => $team->id,
	    'score' => $score
	  );
	}

}
