<?php

namespace Fantasee\Http\Middleware;

use Closure;
use Fantasee\Exceptions\DevOnlyException;
use Illuminate\Contracts\Foundation\Application;

class DevOnlyMiddleware
{
    /**
   * @var App
   */
  private $app;

    /**
     * Handle an incoming request.
     *
     * @param Application $app
     *
     * @internal param \Illuminate\Http\Request $request
     * @internal param Closure $next
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

  /**
   * @param $request
   * @param Closure $next
   *
   * @return mixed
   *
   * @throws DevOnlyException
   */
  public function handle($request, Closure $next)
  {
      $allowedEnvs = ['dev', 'local'];

      if (in_array($this->app->environment(), $allowedEnvs) == false) {
          throw new DevOnlyException($request->path);
      }

      return $next($request);
  }
}
