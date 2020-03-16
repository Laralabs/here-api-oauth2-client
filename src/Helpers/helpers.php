<?php

use Laralabs\HereOAuth\HereOAuth;

if (!function_exists('getHereApiToken')) {
    function getHereApiToken(): ?string
    {
        return app(HereOAuth::class)->getToken();
    }
}
