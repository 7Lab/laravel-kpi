<?php

namespace SevenLab\Kpi\Commands\Concerns;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Schema;

trait HasExternalConnection
{

    /**
     * The guzzleClient for external connection
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Get guzzle client from environment files
     *
     * @return Client | boolean
     */
    public function getClient()
    {
        $kpiUrl = config('kpi.url');
        $kpiToken = config('kpi.token');

        if (isset($kpiUrl, $kpiToken)) {
            return new Client([
                'base_uri' => $kpiUrl,
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $kpiToken,
                    'Content-Type' => 'application/json',
                ]
            ]);
        }

        return false;
    }

    /**
     * Send stats to external server
     *
     * @param array $attributes
     */
    public function sendStats($path, $attributes)
    {
        $this->client->post(config('kpi.endpoint') . $path, [ //sprintf
            'json' => $attributes
        ]);

        $this->info('Measured user count statistics.');
    }

    /**
     * Validate package settings to make sure all will go well.
     *
     * @return bool
     */
    public function validate()
    {
        if (config('kpi.stats_enabled') === false) {
            $this->info('Stats are not enabled.');
            return false;
        }
        if ($this->client === false) {
            $this->error('Guzzle client was not set, environments missing.');
            return false;
        }
        if (Schema::hasTable(config('kpi.users_table_name')) === false) {
            $this->error('Table "' . config('kpi.users_table_name') .'" doesn\'t exist.');
            return false;
        }

        return true;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->client = $this->getClient();

        if ($this->validate() === false) {
            return;
        }

        $this->gatherStats();
    }
}
