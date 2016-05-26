<?php namespace Fantasee\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminMiddleware {

	/**
	* The Guard implementation.
	*
	* @var Guard
	*/
	protected $auth;

	/**
	* Create a new filter instance.
	*
	* @param  Guard  $auth
	* @return void
	*/
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 * If the current user is not the owner of the league, redirect to login
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if ($request->route()->parameter('leagues')->user_id != $this->auth->user()->id)
		{
			return redirect()->guest('auth/login');
		}

		return $next($request);
	}

}
