<?php

namespace Fantasee\Jobs;

use Fantasee\Team;
use Fantasee\Match;
use Fantasee\Week;
use Fantasee\Playoff;

class ScrapePlayoffs extends BaseScraper
{
    /**
     * Create a new Job instance.
     */
    public function __construct($league)
    {
        parent::__construct($league);
    }

    /**
     * Execute the Job.
     */
    public function handle()
    {
        $this->scrapePlayoffs($this->league->seasons);
    }

    /**
     * scrapePlayoffs
     * $seasons Array - array of Season models.
     */
    private function scrapePlayoffs($seasons)
    {
        foreach ($seasons as $season) {
            $crawler = $this->client->request('GET', $this->baseUrl.'/'.$season->year.'/playoffs?bracketType=championship&standingsTab=playoffs');
            $bracket = $this->mapBracket($crawler->filter('.playoffNav .selected a span')->text());
            $weeks = $crawler->filter('#leaguePlayoffsPlayoffs .content .weekLabels ul li h4');

            $weeks->each(function ($node, $i) use ($crawler, $season, $bracket) {

              $week = Week::find(filter_var($node->text(), FILTER_SANITIZE_NUMBER_INT));
              $playoffWeek = $crawler->filter('#leaguePlayoffsPlayoffs .playoffWrap .playoffContent > li')->eq($i);
              $playoffMatches = $playoffWeek->filter('ul > li');

              $playoffMatches->each(function ($node) use ($bracket, $season, $week) {
                // it's a bye week
                // or no teams
                if ($node->filter('.teamsWrap .teamWrap-bye')->count()
                    || $node->filter('.teamsWrap .teamWrap-1')->count() == 0) {
                    return;
                }

                $team1 = Team::byLeague($this->league->id)
                  ->bySeason($season->id)
                  ->where('name', $node->filter('.teamsWrap .teamWrap-1 .teamName')->text())
                  ->firstOrFail();

                $match = Match::byTeam($team1->id)->bySeason($season->id)->byWeek($week->id)->firstOrFail();
                $stage = $this->mapStage($node->filter('h5')->text());

                $playoff = Playoff::updateOrCreate([
                  'match_id' => $match->id,
                  'type' => $bracket,
                  'stage' => $stage,
                ]);

              });
            });
        }
    }

    private function mapBracket($bracket)
    {
        $map = [
        'Championship' => 'championship',
        'Consolation' => 'consolation',
      ];

        return $map[$bracket];
    }

    private function mapStage($stage)
    {
        $map = [
        'Quarterfinal' => 'quarter',
        'Semifinal' => 'semi',
        'Championship' => 'final',
      ];

        if (array_key_exists($stage, $map) == false) {
            return 'other';
        }

        return $map[$stage];
    }
}
