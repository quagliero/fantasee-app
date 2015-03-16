<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Requests\CreateLeagueManagerRequest;
use Fantasee\Http\Controllers\Controller;
use Fantasee\League;
use Fantasee\Season;
use Fantasee\Manager;
use Illuminate\Http\Request;

class LeagueManagerController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @param	ManagerRepository	$managers
	 * @return void
	 */
	public function __construct(Manager $managers)
	{
		$this->managers = $managers;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(League $league)
	{
		$managers = $this->managers->get();

		return view('league_manager.index', compact('league', 'managers'));
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
	public function store(CreateLeagueManagerRequest $request, Manager $manager)
	{
		$manager->create($request->all());
		return redirect()->route('leagues_path');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  League  $league
	 * @param  Manager  $manager
	 * @return Response
	 */
	public function show(League $league, Manager $manager)
	{
		return view('league_manager.show', compact('league', 'manager'));
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
