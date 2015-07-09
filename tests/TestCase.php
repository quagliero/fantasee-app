<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

  public function setUp() {
    parent::setUp();
    Artisan::call('migrate');
    Artisan::call('db:seed');
  }

  public function tearDown() {
    parent::tearDown();
    Artisan::call('migrate:rollback');
  }
}
