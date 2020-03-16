<?php

namespace Laralabs\HereOAuth\Tests\Fakes\Factories;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Laralabs\HereOAuth\Factories\HereOAuthToken;
use Laralabs\HereOAuth\Factories\OAuthHeader;

class FakeHereOAuthToken extends HereOAuthToken
{
    public function __construct(OAuthHeader $header, string $tokenUrl)
    {
        parent::__construct($header, $tokenUrl);

        $this->client = new Client([
            'handler' => $this->createMockGuzzleHandler(),
        ]);
    }

    private function createMockGuzzleHandler(): MockHandler // phpcs:ignore
    {
        return new MockHandler([
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'access_token' => 'MOCK_ACCESS_TOKEN',
                    'token_type' => 'bearer',
                    'expires_in' => 86399,
                ])
            ),
        ]);
    }
}
