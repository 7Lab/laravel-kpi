<?php

namespace SevenLab\Kpi\Tests;

use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;


class UserLastLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_logging_in_gets_new_last_login()
    {
        $user = factory(User::class)->create();

        auth()->login($user);

        $this->assertNotNull($user->last_login);
    }
}
