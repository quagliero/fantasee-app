<?php namespace Fantasee\Http\Controllers;

use Fantasee\League;

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
	public function __construct(League $leagues)
	{
		$this->leagues = $leagues;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$leagues = $this->leagues->orderByRaw('RAND()')->limit(3)->get();

		return view('welcome', compact('leagues'));
	}

}
