<?php

namespace Ptdot\LdapAuth;

use Illuminate\Support\Facades\Auth;

class LdapAuth
{
    /**
     * Attempting given credential through LDAP
     * After successfully connect LDAP,
     * given username will be authenticated using predefined model
     *
     * @param $username
     * @param $password
     * @return array
     */
    public function attempt($username, $password)
    {
        try {
            $this->bind($this->connect(), $username, $password);
            Auth::login($this->fetchUser($username));
            return ['status' => true, 'message' => 'Success login LDAP.'];
        } catch (LdapException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Connect to LDAP host
     *
     * @return resource
     * @throws LdapException
     */
    protected function connect()
    {
        try {
            return ldap_connect(config('ldap.host'), config('ldap.port'));
        } catch (\Exception $e) {
            throw new LdapException('Failed to connect LDAP Server.');
        }
    }

    /**
     * Bind credential to LDAP
     *
     * @param $ldapConnection
     * @param $dn / $username
     * @param $password
     * @throws LdapException
     */
    protected function bind($ldapConnection, $dn, $password)
    {
        try {
            ldap_set_option($ldapConnection, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_bind($ldapConnection, $dn, $password);
        } catch (\Exception $e) {
            ldap_close($ldapConnection);
            throw new LdapException('Login failed. Check your LDAP credential.');
        }
    }

    /**
     * Fetch user from database by given username
     * for system authentication
     *
     * @param $username
     * @return mixed
     * @throws LdapException
     */
    protected function fetchUser($username)
    {
        $userModel = '\\'.ltrim(config('ldap.user'), '\\');
        $user = ((new $userModel))->where(config('ldap.usernameField'), $username)->first();
        if (is_null($user)) {
            throw new LdapException('User is not registered in the system.');
        }
        return $user;
    }
}
