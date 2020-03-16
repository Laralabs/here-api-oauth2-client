<p align="center">
    <img src="http://assets.laralabs.uk/images/logos/laralabs_logo_big.png" height="267px" width="182px" />
</p>


## HERE API OAuth 2.0 Client

Easily retrieve OAuth 2.0 bearer access token to use with the HERE API services.

## :rocket: Quick Start

Require the package in the `composer.json` of your project.
```
composer require laralabs/here-api-oauth2-client
```

Set the following variables in your `env` file, you can get these from the [HERE Developer Site](http://developer.here.com/).
Check in the REST section for OAuth 2.0 Tokens.

```
HERE_OAUTH_ACCESS_ID="your-access-key-id"
HERE_OAUTH_ACCESS_SECRET="your-access-key-secret"
```

Now you can retrieve an access token using either the facade or helper function.
The package will return an access token from the cache or request a new one if it has expired.

### Helper function
```php
$token = getHereApiToken();
```

### Facade
```php
use Laralabs\HereOAuth\Facade\HereOAuth;

$token = HereOAuth::getToken();
```

## :clap: Credits
Special thanks to [Roberto](https://github.com/roberto-butti/) for his assistance in getting the signing working correctly, go check out his repositories if you're looking for a pure PHP library :thumbsup:
