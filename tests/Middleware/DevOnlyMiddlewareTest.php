<?php

use Fantasee\Exceptions\DevOnlyException;
use Fantasee\Http\Middleware\DevOnlyMiddleware;
use Illuminate\Http\Request;

class DevOnlyMiddlewareTest extends TestCase
{
    public function testShouldThrowOnADevOnlyRouteIfInProduction()
    {
        $this->expectException(DevOnlyException::class);

        $request = Mockery::mock(Request::class)->makePartial();
        $request->shouldReceive('all')->andReturn([]);
        $request->shouldReceive('path')->andReturn('dev');

        $application = Mockery::mock(Illuminate\Contracts\Foundation\Application::class);
        $application->shouldReceive('environment')->andReturn('production');

        $middleware = new DevOnlyMiddleware($application);

        $middleware->handle($request, function () {});
    }
    public function testShouldAllowInDevMode()
    {
        $request = Mockery::mock(Request::class)->makePartial();
        $request->shouldReceive('all')->andReturn([]);
        $request->shouldReceive('path')->andReturn('dev');

        $application = Mockery::mock(Illuminate\Contracts\Foundation\Application::class);
        $application->shouldReceive('environment')->andReturn('dev');

        $next = function () {};

        $middleware = new DevOnlyMiddleware($application);

        $middleware->handle($request, $next);

        // Seems backwards, but PHPUnit doesnt have "assertDoesNotThrow" :/
        $this->assertTrue(true);
    }
}
