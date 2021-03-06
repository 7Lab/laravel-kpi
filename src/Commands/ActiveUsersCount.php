<?php

namespace SevenLab\Kpi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use SevenLab\Kpi\Commands\Concerns\HasExternalConnection;
use SevenLab\Kpi\Commands\Concerns\KpiCommand;

class ActiveUsersCount extends Command implements KpiCommand
{
    use HasExternalConnection;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kpi:active-user-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push user count statistics';

    public function gatherStats()
    {
        $usersTableName = config('kpi.users_table_name');
        $lastLoginCol = config('kpi.last_login_column_name');

        if (Schema::hasTable($usersTableName)) {
            $query = DB::table($usersTableName);

            if (Schema::hasColumn($usersTableName, 'deleted_at')) {
                $query->whereNull('deleted_at');
            }

            if (Schema::hasColumn($usersTableName, $lastLoginCol)) {
                $query
                    ->where($lastLoginCol, '>', Carbon::now()->subDays(config('kpi.active_period')));
            }

            $activeTotal = $query
                ->count();

            $this->sendStats('kpi/users', [
                'active_total' => $activeTotal,
            ]);
        }
    }
}
