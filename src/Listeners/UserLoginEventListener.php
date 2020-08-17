<?php

namespace SevenLab\Kpi\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Carbon;

class UserLoginEventListener
{
    public function handle(Login $event)
    {
        $column = config('kpi.last_login_column_name', 'last_login_at');
        $event->user->{$column} = Carbon::now();
        $event->user->save();
    }
}