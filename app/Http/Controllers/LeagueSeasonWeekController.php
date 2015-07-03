<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;
use Fantasee\League;
use Fantasee\Season;
use Fantasee\Week;
use Fantasee\Repositories\Match\MatchRepository;
use Illuminate\Http\Request;

class LeagueSeasonWeekController extends Controller {

	/**
	 * @var MatchRepository
	 */
	private $repository;

	/**
	 * Create a new controller instance.
	 *
	 * @param	MatchRepository	$leagues
	 * @return void
	 */
	public function __construct(MatchRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Display a listing of the resource.
	 * @param  League  $league
	 * @param  Season  $season
	 * @return Response
	 */
	public function index(League $league, Season $season)
	{
		$weeks = $league->seasonWeeks($season->id)->get();
		$matches = $this->repository->getByLeagueSeasonWeek($league->id, $season->id, 1);

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

		$matches = $this->repository->getByLeagueSeasonWeek($league->id, $season->id, $week->id);

		return view('league_season_week.show', compact('league', 'season', 'weeks', 'week', 'matches'));
	}

}
