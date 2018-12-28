<?php

namespace SevenLab\Kpi\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kpi:user-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push user count statistics';

    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->client = new Client([
            'base_uri' => config('kpi.url'),
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . config('kpi.token'),
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (Schema::hasTable('users')) {
            if (Schema::hasColumn('users', 'deleted_at')) {
                $user_count = DB::table('users')->whereNull('deleted_at')->count();
            } else {
                $user_count = DB::table('users')->count();
            }

            $this->client->post('/user-count', [
                'json' => [
                    'application_id' => config('kpi.app_id'),
                    'user_count' => $user_count,
                ]
            ]);

            $this->info('Measured user count statistics.');
        } else {
            $this->error('Table "users" doesn\'t exist.');
        }
    }
}
