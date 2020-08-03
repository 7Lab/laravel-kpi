<?php

namespace SevenLab\Kpi\Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use SevenLab\Kpi\Tests\TestCase;
use SevenLab\Kpi\Tests\User;

class UsersCountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function total_users_count_should_be_correct()
    {
        factory(User::class)->create();

        $query = DB::table(config('kpi.users_table_name'));

        if (Schema::hasColumn(config('kpi.users_table_name'), 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        self::assertEquals(1, $query->count());
        self::artisan('kpi:total-user-count')->run();

    }

    /** @test */
    public function total_active_users_count_should_be_correct()
    {
        $user = factory(User::class)->create();

        $query = DB::table(config('kpi.users_table_name'));

        if (Schema::hasColumn(config('kpi.users_table_name'), 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        if (Schema::hasColumn(config('kpi.users_table_name'), config('kpi.last_login_column_name'))) {

            $activeTotal = $query
                ->where(config('kpi.last_login_column_name'), '>', Carbon::now()->subDays(config('kpi.active_period')))
                ->count();

            self::assertEquals(0, $activeTotal);

        } else {

            $activeTotal = $query->count();
            self::assertEquals(1, $activeTotal);

        }

        $this->actingAs($user, 'api');

        if (Schema::hasColumn(config('kpi.users_table_name'), 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        if (Schema::hasColumn(config('kpi.users_table_name'), config('kpi.last_login_column_name'))) {

            $activeTotal = $query
                ->where(config('kpi.last_login_column_name'), '>', Carbon::now()->subDays(config('kpi.active_period')))
                ->count();

            self::assertEquals(1, $activeTotal);

        }

    }

    /** @test */
    public function total_deleted_users_count_should_be_correct()
    {
        $user = factory(User::class)->create();
        if (Schema::hasColumn(config('kpi.users_table_name'), 'deleted_at')) {
            $deletedCount = DB::table(config('kpi.users_table_name'))->whereNotNull('deleted_at')->count();
            self::assertEquals(0, $deletedCount);
        }

        $user->delete();

        if (Schema::hasColumn(config('kpi.users_table_name'), 'deleted_at')) {
            $deletedCount = DB::table(config('kpi.users_table_name'))->whereNotNull('deleted_at')->count();
            self::assertEquals(1, $deletedCount);
        }

        self::artisan('kpi:deleted-user-count')->run();
    }
}
