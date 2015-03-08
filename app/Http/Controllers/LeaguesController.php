<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
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
		//
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
		//
		return view('league.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, League $league)
	{
		//
		$league->create($request->all());

		return redirect()->route('leagues_path');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param	int	$id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$league = $this->leagues->find($id);
		return view('league.show', compact('league'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param	int	$id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param	int	$id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param	int	$id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
