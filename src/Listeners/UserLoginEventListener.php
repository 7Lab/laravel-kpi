<?php

namespace SevenLab\Kpi\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Carbon;

class UserLoginEventListener
{
    public function handle(Login $event)
    {
        $event->user->${config('kpi.last_login_column_name')} = Carbon::now();
        $event->user->save();
    }
}