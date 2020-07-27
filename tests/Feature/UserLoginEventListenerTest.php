<?php

namespace SevenLab\Kpi\Tests;

use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use SevenLab\Kpi\Listeners\UserLoginEventListener;

class UserLoginEventListenerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_login_event_should_update_user_last_login()
    {
        $user = factory(User::class)->create();

        (new UserLoginEventListener())->handle(
            new Login('api', $user, null)
        );

        $this->assertNotNull($user->last_login);
    }
}
