<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;
use Fantasee\Manager;
use Fantasee\League;
use Fantasee\Season;
use Illuminate\Http\Request;

class LeagueManagerSeasonController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(League $league, Manager $manager, Season $season)
	{
		return view('league_manager_season.index', ['league' => $league, 'manager' => $manager, 'season' => $season]);
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
		$team = $manager->team($season->id);
		return view('league_manager_season.show', ['league' => $league, 'manager' => $manager, 'season' => $season, 'team' => $team]);
	}

}
