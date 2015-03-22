<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;
use Fantasee\League;
use Fantasee\Season;
use Fantasee\Week;
use Fantasee\Match;
use Illuminate\Http\Request;

class LeagueSeasonWeekController extends Controller {
	
	/**
	 * Display a listing of the resource.
	 * @param  League  $league
	 * @param  Season  $season
	 * @return Response
	 */
	public function index(League $league, Season $season)
	{
		$weeks = $league->seasonWeeks($season->id)->get();
		$matches = Match::byLeague($league->id)->bySeason($season->id)->byWeek(1)->get();
		return view('league_season_week.index', compact('league', 'season', 'weeks', 'matches'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  League  $league
	 * @param  Season  $season
	 * @param  Week  	 $week
	 * @return Response
	 */
	public function show(League $league, Season $season, Week $week)
	{
		$weeks = $league->seasonWeeks($season->id)->get();
		$matches = Match::byLeague($league->id)->bySeason($season->id)->byWeek($week->id)->get();
		return view('league_season_week.show', compact('league', 'season', 'weeks', 'week', 'matches'));
	}

}
