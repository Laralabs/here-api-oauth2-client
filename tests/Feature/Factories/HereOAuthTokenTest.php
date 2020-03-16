<?php

namespace Laralabs\HereOAuth\Tests\Feature\Factories;

use Laralabs\HereOAuth\Factories\HereOAuthToken;
use Laralabs\HereOAuth\Factories\OAuthHeader;
use Laralabs\HereOAuth\Tests\Fakes\Factories\FakeHereOAuthToken;
use Laralabs\HereOAuth\Tests\TestCase;

class HereOAuthTokenTest extends TestCase
{
    /**
     * @var FakeHereOAuthToken
     */
    protected $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->swap(
            HereOAuthToken::class,
            new FakeHereOAuthToken(
                app(OAuthHeader::class),
                config('here-oauth.token_url')
            )
        );
        $this->factory = app(HereOAuthToken::class);
    }

    /** @test */
    public function it_can_retrieve_a_new_access_token(): void
    {
        $result = $this->factory->generate();

        $this->assertArrayHasKey('access_token', $result);
        $this->assertArrayHasKey('token_type', $result);
        $this->assertArrayHasKey('expires_in', $result);
        $this->assertEquals('MOCK_ACCESS_TOKEN', $result['access_token']);
    }
}
