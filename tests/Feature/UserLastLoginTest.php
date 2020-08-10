<?php

namespace SevenLab\Kpi\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;


class UserLastLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_logging_in_gets_new_last_login()
    {
        $user = factory(User::class)->create();

        auth()->login($user);

        $this->assertNotNull($user->last_login_at);
    }
}
