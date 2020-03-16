<?php

namespace Laralabs\HereOAuth\Tests\Unit\Cache;

use Laralabs\HereOAuth\Cache\Manager;
use Laralabs\HereOAuth\Exceptions\HereOAuthTokenExpired;
use Laralabs\HereOAuth\Tests\TestCase;

class ManagerTest extends TestCase
{
    /**
     * @var Manager
     */
    protected $manager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = app(Manager::class);
    }

    /** @test */
    public function it_throws_an_expired_token_exception_if_not_present_in_cache(): void
    {
        $this->expectException(HereOAuthTokenExpired::class);

        $this->manager->retrieve();
    }

    /** @test */
    public function it_can_retrieve_a_stored_access_token_from_the_cache(): void
    {
        cache()->put(Manager::CACHE_KEY, encrypt('1234'), 85000);

        $result = $this->manager->retrieve();

        $this->assertEquals('1234', $result);
    }

    /** @test */
    public function it_can_store_an_encrypted_access_token_in_the_cache(): void
    {
        $this->manager->store('1234', 85000);

        $this->assertNotEquals('1234', cache(Manager::CACHE_KEY));
        $this->assertEquals('1234', decrypt(cache(Manager::CACHE_KEY)));
    }
}
