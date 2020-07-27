<?php

namespace SevenLab\Kpi;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class KpiUserServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'SevenLab\Kpi\Listeners\UserLoginEventListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
