<?php namespace Fantasee\Http\Controllers;

use Fantasee\League;
use Fantasee\Repositories\League\LeagueRepository;
use Fantasee\Repositories\Manager\ManagerRepository;
use Fantasee\Repositories\Team\TeamRepository;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(
	  LeagueRepository $leagues,
		ManagerRepository $managers,
		TeamRepository $teams
	){
		$this->leagues = $leagues;
		$this->managers = $managers;
		$this->teams = $teams;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$league_count = $this->leagues->count();
		$manager_count = $this->managers->count();
		$team_count = $this->teams->count();
		$leagues = $this->leagues->random(3);

		return view('welcome', compact('leagues', 'league_count', 'manager_count', 'team_count'));
	}

}
