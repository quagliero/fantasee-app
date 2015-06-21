<?php

namespace Fantasee\Providers;

use Illuminate\Support\ServiceProvider;
use Fantasee\Repositories\League\LeagueRepository;
use Fantasee\Repositories\League\DbLeagueRepository;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LeagueRepository::class, DbLeagueRepository::class);
    }
}
