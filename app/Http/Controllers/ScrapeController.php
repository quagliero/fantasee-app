<?php

namespace Fantasee\Http\Controllers;

use Fantasee\Jobs\ScrapeSeasons;
use Fantasee\Jobs\ScrapeManagers;
use Fantasee\Jobs\ScrapeTeams;
use Fantasee\Jobs\ScrapeStandings;
use Fantasee\Jobs\ScrapeSchedule;
use Fantasee\Jobs\ScrapeDraft;
use Fantasee\Jobs\ScrapeTrades;
use Fantasee\League;
use Illuminate\Http\Request;

class ScrapeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function store(Request $request, League $league)
    {
        // map input keys to their corresponding scraper
        $availableCommands = [
            'seasons' => ScrapeSeasons::class,
            'managers' => ScrapeManagers::class,
            'teams' => ScrapeTeams::class,
            'standings' => ScrapeStandings::class,
            'schedule' => ScrapeSchedule::class,
            'playoffs' => ScrapePlayoffs::class,
            'drafts' => ScrapeDraft::class,
            'trades' => ScrapeTrades::class,
        ];

        // grab the posted keys and compare with available options
        $selectedCommands = array_intersect_key($availableCommands, $request->all());

        foreach ($selectedCommands as $key => $value) {
            $this->dispatch(new $availableCommands[$key]($league));
        }
        // once finished, redirect back to league edit view
        return redirect()->route('league_path', [$league->slug]);
    }
}
