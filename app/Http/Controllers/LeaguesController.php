<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Requests\CreateLeagueRequest;
use Fantasee\Http\Controllers\Controller;
use Fantasee\League;
use Illuminate\Http\Request;

class LeaguesController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @param	LeagueRepository	$leagues
	 * @return void
	 */
	public function __construct(League $leagues)
	{
		$this->leagues = $leagues;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$leagues = $this->leagues->get();

		return view('league.index', compact('leagues'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('league.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateLeagueRequest $request, League $league)
	{
		$league->create($request->all());

		return redirect()->route('leagues_path');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param	League $league
	 * @return Response
	 */
	public function show(League $league)
	{
		$managers = $league->managers()->get()->sort(function ($manager1, $manager2) {
			return $manager1->getWins() < $manager2->getWins();
		});

		return view('league.show', compact('league', 'managers'));
	}

	/**
	 * Display all the teams of the league
	 *
	 * @param	League $league
	 * @return Response
	 */
	public function teams(League $league)
	{
		$teams = $league->teams()->get()->sort(function ($team1, $team2) {
			return $team1->getWins() < $team2->getWins();
		});

		return view('league.teams', compact('league', 'teams'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param	League $league
	 * @return Response
	 */
	public function edit(League $league)
	{

		return view('league.edit', compact('league'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param	League $leagued
	 * @return Response
	 */
	public function update(League $league, Request $request)
	{
		$league->fill($request->all())->save();

		return redirect()->route('league_path', [$league->league_id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param	int	$id
	 * @return Response
	 */
	public function destroy(League $league)
	{
		$league->delete();
		return redirect()->route('leagues_path');
	}

}
