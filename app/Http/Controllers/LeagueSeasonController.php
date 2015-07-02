<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;
use Fantasee\League;
use Fantasee\Season;
use Fantasee\Team;
use Fantasee\Repositories\Team\TeamRepository;
use Illuminate\Http\Request;

class LeagueSeasonController extends Controller {

	/**
	 * $repository
	 * @var Fantasee\Repositories\Team\TeamRepository
	 */
	private $repository;

	/**
	 * Create a new controller instance.
	 *
	 * @param	TeamRepository	$repository
	 * @return void
	 */
	public function __construct(TeamRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  League  $league
	 * @return Response
	 */
	public function show(League $league, Season $season)
	{
		$teams = $this->repository->getByLeagueSeason($league->id, $season->id);

		return view('league_season.show', compact('league', 'season', 'teams'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
