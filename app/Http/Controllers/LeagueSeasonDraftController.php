<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;
use Fantasee\League;
use Fantasee\Season;
use Fantasee\Team;
use Fantasee\Draft;
use Fantasee\Pick;
use Illuminate\Http\Request;

class LeagueSeasonDraftController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @param	LeagueRepository	$league
	 * @param	SeasonRepository	$season
	 * @return void
	 */
	public function __construct(League $league, Season $season)
	{
		$this->draft = Draft::byLeague($league->id)->bySeason($season->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  League  $league
	 * @return Response
	 */
	public function show(League $league, Season $season)
	{
		$teams = Team::byLeague($league->id)->bySeason($season->id)->orderBy('position')->get();
		$draft = Draft::byLeague($league->id)->bySeason($season->id)->first();
		$picks = Pick::byDraft($draft->id)->get();

		return view('league_season_draft.show', compact('league', 'season', 'teams', 'picks'));
	}

}
