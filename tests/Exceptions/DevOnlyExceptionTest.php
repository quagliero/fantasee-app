<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DevOnlyExceptionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProducesAnExceptionString()
    {
        $e = new \Fantasee\Exceptions\DevOnlyException('/dev');
        $this->assertContains('Fantasee\Exceptions\DevOnlyException: Unable to resolve /dev as it is only intended for use in development environments.', $e->__toString());
    }
}
