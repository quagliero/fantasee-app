<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {

	Route::get('/', [
		'uses' => 'WelcomeController@index',
		'as' => 'root_path'
		]);

	Route::get('home', [ // currently not used
		'uses' => 'HomeController@index',
		'as' => 'home_path'
		]);

	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);

	/* Non-resource /leagues/{$league} routes */
	Route::get('leagues/{leagues}/teams', [
		'uses' => 'LeaguesController@teams',
		'as' => 'league_teams_path'
	]);

	Route::get('leagues/{leagues}/drafts', [
		'uses' => 'LeaguesController@drafts',
		'as' => 'league_drafts_path'
	]);

	Route::get('leagues/{leagues}/seasons/{seasons}/draft', [
		'uses' => 'LeagueSeasonDraftController@show',
		'as' => 'league_season_draft_path'
	]);

	/* League scraper */
	Route::post('leagues/{leagues}/scrape', [
		'uses' => 'ScrapeController@store',
		'as' => 'league_scrape',
	]);

	Route::resource('users', 'UsersController', [
		'names' => [
			'index' => 'users_path',
			'show' => 'user_path',
			'create' => 'user_create',
			'store' => 'user_store',
			'edit' => 'user_edit',
			'update' => 'user_update',
			'destroy' => 'user_destroy',
		]
	]);

	Route::resource('leagues', 'LeaguesController', [
		'names' => [
			'index' => 'leagues_path',
			'show' => 'league_path',
			'create' => 'league_create',
			'store' => 'league_store',
			'edit' => 'league_edit',
			'update' => 'league_update',
			'destroy' => 'league_destroy',
		]
	]);

	Route::resource('leagues.seasons', 'LeagueSeasonController', [
		'names' => [
			'index' => 'league_seasons_path',
			'show' => 'league_season_path',
			'create' => 'league_season_create',
			'store' => 'league_season_store',
			'edit' => 'league_season_edit',
			'update' => 'league_season_update',
			'destroy' => 'league_season_destroy',
		]
	]);

	Route::resource('leagues.seasons.weeks', 'LeagueSeasonWeekController', [
		'only' => ['index', 'show'],
		'names' => [
			'index' => 'league_season_weeks_path',
			'show' => 'league_season_week_path',
		]
	]);

	Route::resource('leagues.managers', 'LeagueManagerController', [
		'names' => [
			'index' => 'league_managers_path',
			'show' => 'league_manager_path',
			'create' => 'league_manager_create',
			'store' => 'league_manager_store',
			'edit' => 'league_manager_edit',
			'update' => 'league_manager_update',
			'destroy' => 'league_manager_destroy',
		]
	]);

	Route::resource('leagues.managers.seasons', 'LeagueManagerSeasonController', [
		'only' => ['show'],
		'names' => [
			'show' => 'league_manager_season_path',
		]
	]);
});
