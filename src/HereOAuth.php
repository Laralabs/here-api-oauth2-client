<?php

namespace Laralabs\HereOAuth;

use Laralabs\HereOAuth\Cache\Manager as Cache;
use Laralabs\HereOAuth\Exceptions\HereOAuthTokenExpired;
use Laralabs\HereOAuth\Factories\HereOAuthToken;

class HereOAuth
{
    /**
     * @var Cache
     */
    protected $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function getToken(): string
    {
        try {
            return $this->cache->retrieve();
        } catch (HereOAuthTokenExpired $exception) {
            $token = app(HereOAuthToken::class)->generate();

            $this->cache->store($token['access_token'], $token['expires_in']);

            return $token['access_token'];
        }
    }
}
