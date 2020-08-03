<?php

namespace SevenLab\Kpi\Tests;

use SevenLab\Kpi\KpiServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            KpiServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/database/migrations/create_users_table.php.stub';
        (new \CreateUsersTable)->up();

        $this->loadFactoriesUsing($app, __DIR__ . './database/factories');
    }

}