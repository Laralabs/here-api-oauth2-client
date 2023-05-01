<p align="center">
    <img src="https://assets.laralabs.uk/packages/here-oauth2-client/here_client_logo.png" height="154px" width="141px" />
</p>
<p align="center">
<a href="https://packagist.org/packages/laralabs/here-api-oauth2-client"><img src="https://poser.pugx.org/laralabs/here-api-oauth2-client/version" alt="Stable Build" /></a>
<a href="https://github.com/Laralabs/here-api-oauth2-client/actions"><img src="https://github.com/Laralabs/here-api-oauth2-client/actions/workflows/.github-actions.yml/badge.svg" alt="CI Status" /></a>
<a href="https://codeclimate.com/github/Laralabs/here-api-oauth2-client/maintainability"><img src="https://api.codeclimate.com/v1/badges/c4e20b9e6d9fc66e949c/maintainability" /></a>
<a href="https://codeclimate.com/github/Laralabs/here-api-oauth2-client/test_coverage"><img src="https://api.codeclimate.com/v1/badges/c4e20b9e6d9fc66e949c/test_coverage" /></a>
<a href="https://codecov.io/gh/Laralabs/here-api-oauth2-client"><img src="https://codecov.io/gh/Laralabs/here-api-oauth2-client/branch/master/graph/badge.svg?token=LZ3SIO46CN"/></a>
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
