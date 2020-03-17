<?php

namespace Laralabs\HereOAuth\Tests\Feature;

use Laralabs\HereOAuth\Cache\Manager;
use Laralabs\HereOAuth\Tests\TestCase;

class HelperTest extends TestCase
{
    /** @test */
    public function it_can_run_the_helper_function_and_get_an_access_token_back(): void
    {
        app(Manager::class)->store('1234', 85000);

        $result = getHereApiToken();

        $this->assertEquals('1234', $result);
    }
}
