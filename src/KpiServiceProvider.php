<?php

namespace SevenLab\Kpi;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use SevenLab\Kpi\Commands\ActiveUsersCount;
use SevenLab\Kpi\Commands\DeletedUsersCount;
use SevenLab\Kpi\Commands\TotalUsersCount;
use SevenLab\Kpi\Providers\KpiUserServiceProvider;

class KpiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/kpi.php' => config_path('kpi.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                TotalUsersCount::class,
                ActiveUsersCount::class,
                DeletedUsersCount::class,
            ]);
        }

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('kpi:active-user-count')->weeklyOn(7, '23:59');
            $schedule->command('kpi:deleted-user-count')->weeklyOn(7, '23:59');
            $schedule->command('kpi:total-user-count')->weeklyOn(7, '23:59');
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/kpi.php', 'kpi');

        $this->app->register(KpiUserServiceProvider::class);
    }
}
