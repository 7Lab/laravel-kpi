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
        $query = DB::table(config('kpi.user_table_name'));

        if (Schema::hasColumn(config('kpi.user_table_name'), 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        $activeTotal = $query
            ->where(config('kpi.last_login_column_name'), '>', Carbon::subDays(config('kpi.active_period')))
            ->count();

        $this->sendStats('users', [
            'active_total' => $activeTotal,
        ]);
    }
}
