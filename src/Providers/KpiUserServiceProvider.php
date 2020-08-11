<?php

namespace SevenLab\Kpi\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SevenLab\Kpi\Listeners\UserLoginEventListener;

class KpiUserServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Login::class => [
            UserLoginEventListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
