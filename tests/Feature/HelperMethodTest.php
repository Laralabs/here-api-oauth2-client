<?php

namespace Laralabs\HereOAuth\Tests\Feature;

use Laralabs\HereOAuth\Cache\Manager;
use Laralabs\HereOAuth\Tests\TestCase;

class HelperMethodTest extends TestCase
{
    /** @test */
    public function it_can_run_the_helper_function_and_get_an_access_token_back(): void
    {
        cache()->put(Manager::CACHE_KEY, encrypt('1234'));

        $result = getHereApiToken();

        $this->assertEquals('1234', $result);
    }
}
