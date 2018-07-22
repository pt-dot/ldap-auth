# Laravel LDAP Authentication

Laravel LDAP Authentication is a package for authenticating user to Active Directory using **Lightweight Directory Access Protocol** and integrated with Laravel authenticatable model out of the box.

## Requirements
+ Laravel 5.1 - 5.6
+ Enable `PHP LDAP` Extension

## Installation

Install package through composer.

```bash
composer require ptdot/ldapauth
```

Next, if using Laravel under 5.5, include the service provider and Facade within your `config/app.php` file.

```php
'providers' => [
    Ptdot\LdapAuth\LdapAuthServiceProvider::class,
],

'aliases' => [
    'LdapAuth' => Ptdot\LdapAuth\LdapAuthFacade::class,
]
```

Since Laravel 5.5+ is using Package Discovery, there is no need manually insert service provider and facade inside your `app.php`.

## Configuration

Publish config using command:

```bash
php artisan vendor:publish --tag="Ptdot\LdapAuth\LdapAuthServiceProvider"
```

Set keys and values for your LDAP configuration in `.env` file.

```dotenv
LDAP_HOST=ldap.example.com
LDAP_PORT=389
```

Setup your User model or custom authentication model In `config/ldap.php` file and don't forget to adjust your `usernameField` value from your authentication model.

> Make sure you are already has user data in database and create user model for authentication.

```php
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
```

## Usage

For attempting authentication using LDAP:

```php
$result = LdapAuth::attempt($username, $password);
```
Attempt method will return an array that indicate that authentication is success or not.

**Example**

```php
/**
* Logging in using LDAP
*/
public funtion login(Request $request)
{
    $username = $request->get('username');
    $password = $request->get('password');
    
    $login = LdapAuth::attempt($username, $password);
    if($login['status']) {
        return "Login success";
    }
    return "Login failed. Error: ".$login['message'];
}
```

## Contributing

Feel free to report an issue or merge request if you want to help this package become better and useful.