<?php

return [

    /*
     * Specify the Autorization Bearer token that will be used.
     */
    'token' => env('LAB_TOKEN'),

    /*
     * Specify the base url that will be used.
     */
    'url' => env('LAB_BASE_URL'),

    /*
     * Specify the endpoint that will be used for the KPI stats.
     */
    'endpoint' => env('KPI_ENDPOINT', ''),

    /**
     * Define the number of days we will threat as being 'active'
     */
    'active_period' => 7,

    /**
     * Database columns for the user counts
     */
    'users_table_name' => env('KPI_USERS_TABLE_NAME', 'users'),
    'last_login_column_name' => env('KPI_LAST_LOGIN_COLUMN', 'last_login_at'),

];
