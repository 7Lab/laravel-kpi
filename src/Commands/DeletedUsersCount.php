<?php

namespace SevenLab\Kpi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use SevenLab\Kpi\Commands\Concerns\HasExternalConnection;
use SevenLab\Kpi\Commands\Concerns\KpiCommand;

class DeletedUsersCount extends Command implements KpiCommand
{
    use HasExternalConnection;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kpi:deleted-user-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push user count statistics';

    public function gatherStats()
    {
        $usersTableName = config('kpi.users_table_name');

        if (Schema::hasTable($usersTableName)) {
            if (Schema::hasColumn($usersTableName, 'deleted_at')) {
                $deletedCount = DB::table($usersTableName)->whereNotNull('deleted_at')->count();

                $this->sendStats('users', [
                    'deleted_total' => $deletedCount,
                ]);

                $this->info('Measured user count statistics.');
            }
        }
    }
}
