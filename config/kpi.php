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
     * Specify the last login column name.
     */
    'last_login_column_name' => env('KPI_LAST_LOGIN_COLUMN', 'last_login'),
];
