<?php

return [
    /*
    |--------------------------------------------------------------------------
    | HERE API OAuth 2.0 Credentials
    |--------------------------------------------------------------------------
    |
    | These credentials are found in the credentials area of the project in the
    | developer.here.com site.
    |
    | Look for the 'REST' section, and select 'Create Credentials' under the
    | OAuth 2.0 (JSON Web Tokens) title. Set the generated credentials in the
    | env variables used below.
    |
    */
    'access_key_id' => env('HERE_OAUTH_ACCESS_ID', null),
    'access_key_secret' => env('HERE_OAUTH_ACCESS_SECRET', null),
    'token_url' => env('HERE_TOKEN_URL', 'https://account.api.here.com/oauth2/token'),
];
