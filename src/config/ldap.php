<?php

return [
    /*
    |--------------------------------------------------------------------------
    | LDAP Host & Port
    |--------------------------------------------------------------------------
    |
    | This option used for define your LDAP Connection
    | LDAP host is your LDAP domain or IP Address
    | LDAP port is your default LDAP port,
    | or you may override port value from .env
    |
    */
    'host' => env('LDAP_HOST'),
    'port' => env('LDAP_PORT', 389),

    /*
    |--------------------------------------------------------------------------
    | Authentication user model
    |--------------------------------------------------------------------------
    |
    | Authentication is used User model for default.
    | Define this option if authentication model using different model / namespace.
    |
    */
    'user' => App\User::class,
    'usernameField' => 'username'
];
