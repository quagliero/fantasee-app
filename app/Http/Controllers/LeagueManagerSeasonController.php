<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;
use Fantasee\Manager;
use Fantasee\League;
use Fantasee\Season;
use Fantasee\Team;
use Illuminate\Http\Request;

class LeagueManagerSeasonController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(League $league, Manager $manager, Season $season)
	{
		return view('league_manager_season.index', compact('league', 'manager', 'season'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  League  $league
	 * @param  Manager  $manager
	 * @param  Season  $season
	 * @return Response
	 */
	public function show(League $league, Manager $manager, Season $season)
	{
		$team = Team::byLeague($league->id)->bySeason($season->id)->byManager($manager->id)->first();
		return view('league_manager_season.show', compact('league', 'manager', 'season', 'team'));
	}

}
