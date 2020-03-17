<?php

namespace Laralabs\HereOAuth\Tests\Feature;

use Laralabs\HereOAuth\Cache\Manager;
use Laralabs\HereOAuth\Facade\HereOAuth;
use Laralabs\HereOAuth\Tests\TestCase;

class FacadeTest extends TestCase
{
    /** @test */
    public function it_can_get_the_access_token_via_the_facade(): void
    {
        app(Manager::class)->store('1234', 85000);

        $result = HereOAuth::getToken();

        $this->assertEquals('1234', $result);
    }
}
