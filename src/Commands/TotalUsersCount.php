<?php

namespace SevenLab\Kpi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use SevenLab\Kpi\Commands\Concerns\HasExternalConnection;
use SevenLab\Kpi\Commands\Concerns\KpiCommand;

class TotalUsersCount extends Command implements KpiCommand
{
    use HasExternalConnection;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kpi:total-user-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push user count statistics';

    public function gatherStats()
    {
        $userTableName = config('kpi.users_table_name');

        $query = DB::table($userTableName);

        if (Schema::hasColumn($userTableName, 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        $this->sendStats('users', [
            'users_total' => $query->count(),
        ]);
    }
}