<?php

namespace Ptdot\LdapAuth;

use Illuminate\Support\ServiceProvider;
use Ptdot\LdapAuth\LdapAuth;

class LdapAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/ldap.php' => config_path('ldap.php')
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('LdapAuth', function() {
            return new LdapAuth();
        });
    }
}
