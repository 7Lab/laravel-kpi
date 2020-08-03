<?php

namespace SevenLab\Kpi;

use Illuminate\Support\ServiceProvider;
use SevenLab\Kpi\Commands\ActiveUsersCount;
use SevenLab\Kpi\Commands\DeletedUsersCount;
use SevenLab\Kpi\Commands\TotalUsersCount;

class KpiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/kpi.php' => config_path('kpi.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                TotalUsersCount::class,
                ActiveUsersCount::class,
                DeletedUsersCount::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/kpi.php', 'kpi');
    }
}
