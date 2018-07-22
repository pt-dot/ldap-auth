<?php
namespace Ptdot\LdapAuth;

use Illuminate\Support\Facades\Facade;

class LdapAuthFacade extends Facade
{
    /**
     * Facade Accessor
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'LdapAuth';
    }
}
