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

Route::bind('leagues', function($slug)
{
	return Fantasee\League::where('league_id', $slug)->first();
});

Route::resource('leagues', 'LeaguesController', [
	'names' => [
		'index' => 'leagues_path',
		'show' => 'league_path',
		'create' => 'league_create',
		'store' => 'league_store',
		'edit' => 'league_edit',
		'update' => 'league_update',
	]
]);
