<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;
use Fantasee\Manager;
use Fantasee\League;
use Fantasee\Season;
use Fantasee\Repositories\Team\TeamRepository;
use Illuminate\Http\Request;

class LeagueManagerSeasonController extends Controller {

	/**
	 * @var TeamRepository
	 */
	private $repository;

	/**
	 * Create a new controller instance.
	 *
	 * @param	TeamRepository	$leagues
	 * @return void
	 */
	public function __construct(TeamRepository $repository)
	{
		$this->repository = $repository;
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
		$team = $this->repository->getBySeasonManager($season->id, $manager->id);

		return view('league_manager_season.show', compact('league', 'manager', 'season', 'team'));
	}

}
