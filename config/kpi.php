<?php

return [

    /*
     * Specify the Autorization Bearer token that will be used.
     */
    'token' => env('KPI_TOKEN'),

    /*
     * Specify the url that will be used.
     */
    'url' => env('KPI_URL'),

    /*
     * Specify the application ID that will be send together with the statistics.
     */
    'app_id' => env('KPI_APP_ID', str_slug(config('app.name'), '-')),

];
