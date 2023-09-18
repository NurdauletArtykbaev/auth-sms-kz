<?php

namespace NurdauletArtykbaev\CoreAuth\Test;

use Orchestra\Testbench\TestCase;

class FeatureTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }
    protected function getPackageProviders($app)
    {
        return [
            'NurdauletArtykbaev\CoreAuth\Providers\AuthServiceProvider',
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}