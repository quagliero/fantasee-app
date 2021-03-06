<?php namespace Fantasee\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Fantasee\Repositories\League\LeagueRepository;
use Fantasee\User;
use Fantasee\Season;
use Fantasee\Week;
use Fantasee\Manager;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'Fantasee\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		$router->bind('users', function($user)
		{
			return User::findOrFail($user);
		});

		$router->bind('leagues', function($slug)
		{
			return app(LeagueRepository::class)->getBySlug($slug);
		});

		$router->bind('seasons', function($season)
		{
			return Season::where('year', $season)->firstOrFail();
		});

		$router->bind('weeks', function($week)
		{
			return Week::findOrFail($week);
		});

		$router->bind('managers', function($manager)
		{
			return Manager::findOrFail($manager);
		});
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
