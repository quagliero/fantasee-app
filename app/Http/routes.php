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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/* Non-resource /leagues/{$league} routes */
Route::get('leagues/{leagues}/teams', [
	'uses' => 'LeaguesController@teams',
	'as' => 'league_teams_path'
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
	'only' => ['index', 'show'],
	'names' => [
		'index' => 'league_manager_seasons_path',
		'show' => 'league_manager_season_path',
	]
]);
