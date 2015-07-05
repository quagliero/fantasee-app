<?php

namespace Fantasee\Providers;

use Illuminate\Support\ServiceProvider;
use Fantasee\Repositories\League\LeagueRepository;
use Fantasee\Repositories\League\DbLeagueRepository;
use Fantasee\Repositories\Team\TeamRepository;
use Fantasee\Repositories\Team\DbTeamRepository;
use Fantasee\Repositories\Match\MatchRepository;
use Fantasee\Repositories\Match\DbMatchRepository;
use Fantasee\Repositories\Manager\ManagerRepository;
use Fantasee\Repositories\Manager\DbManagerRepository;
use Fantasee\Repositories\Draft\DraftRepository;
use Fantasee\Repositories\Draft\DbDraftRepository;

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
        $this->app->bind(TeamRepository::class, DbTeamRepository::class);
        $this->app->bind(MatchRepository::class, DbMatchRepository::class);
        $this->app->bind(ManagerRepository::class, DbManagerRepository::class);
        $this->app->bind(DraftRepository::class, DbDraftRepository::class);
    }
}
