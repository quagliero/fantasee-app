<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Requests\CreateLeagueRequest;
use Fantasee\Http\Requests\UpdateLeagueRequest;
use Fantasee\Http\Controllers\Controller;
use Fantasee\Repositories\League\LeagueRepository;
use Fantasee\League;
use Illuminate\Http\Request;
use Fantasee\Jobs\ScrapeLeague;

class LeaguesController extends Controller {

	/**
	 * @var LeagueRepository
	 */
	private $repository;

	/**
	 * Create a new controller instance.
	 *
	 * @param	LeagueRepository	$leagues
	 * @return void
	 */
	public function __construct(LeagueRepository $repository)
	{
		$this->repository = $repository;

		$this->middleware('auth', ['only' => ['create', 'edit', 'update', 'destroy']]);
		$this->middleware('admin', ['only' => ['edit', 'update', 'destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$leagues = $this->repository->getAll();

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
		// Create the new league instance
		$newLeague = $league->create($request->all());
		// Scrape initial data
		$this->dispatch(new ScrapeLeague($newLeague));

		return redirect()->route('league_edit', [$newLeague->slug]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param	League $league
	 * @return Response
	 */
	public function show(League $league)
	{
		$managers = $league->getManagersByWins();

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
		$teams = $league->getTeamsByWins();

		return view('league.teams', compact('league', 'teams'));
	}

	/**
	 * Display all the drafts of the league
	 *
	 * @param	League $league
	 * @return Response
	 */
	public function drafts(League $league)
	{
		$drafts = $league->drafts;

		return view('league.drafts', compact('league', 'drafts'));
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
	public function update(League $league, UpdateLeagueRequest $request)
	{
		$league->fill($request->all())->save();

		return redirect()->route('league_path', [$league->slug]);
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
