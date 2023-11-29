<?php

namespace Arcplg\Smaregi\Tests;

use Arcplg\Smaregi\SmaRegiBaseServiceProvider;


class TestCase extends \Orchestra\Testbench\TestCase
{


    protected function setUp(): void
    {
        parent::setUp();

        // $this->withFactories(__DIR__ . '/../database/factories');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app)
    {
        return [
            SmaRegiBaseServiceProvider::class,
        ];
    }


    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);
    }
}