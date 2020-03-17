<?php

namespace Laralabs\HereOAuth\Cache;

use Illuminate\Cache\Repository as CacheRepository;
use Laralabs\HereOAuth\Exceptions\HereOAuthTokenExpired;

class Manager
{
    public const CACHE_KEY = 'here.api.oauth.token';

    /**
     * @var CacheRepository
     */
    protected $cache;

    public function __construct(CacheRepository $cache)
    {
        $this->cache = $cache;
    }

    public function retrieve(): string
    {
        throw_unless($this->cache->has(self::CACHE_KEY), new HereOAuthTokenExpired);

        return decrypt($this->cache->get(self::CACHE_KEY));
    }

    public function store(string $token, int $expiry): bool
    {
        $this->cache->put(self::CACHE_KEY, encrypt($token), $expiry - 10);

        return $this->cache->has(self::CACHE_KEY);
    }
}
