<?php

namespace Fantasee\Http\Controllers;

use Fantasee\League;
use Fantasee\Season;
use Fantasee\Repositories\Trade\TradeRepository;

class LeagueSeasonTradeController extends Controller
{
    public function show(League $league, Season $season, TradeRepository $trade)
    {
        $seasons = $league->seasons;
        $trades = $trade->getByLeagueSeason($league->id, $season->id)->sortBy('id');

        return view('league_season_trades.show', compact('trades', 'league', 'season', 'seasons'));
    }
}
