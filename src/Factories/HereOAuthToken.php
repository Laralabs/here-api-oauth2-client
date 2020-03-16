<?php

namespace Laralabs\HereOAuth\Factories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Log;
use Laralabs\HereOAuth\Exceptions\ErrorRetrievingHereApiToken;

class HereOAuthToken
{
    /**
     * @var OAuthHeader
     */
    protected $header;

    /**
     * @var string
     */
    protected $tokenUrl;

    /**
     * @var Client
     */
    protected $client;

    /*
     * @var int
     */
    protected $attempts = 0;

    /**
     * @var int
     */
    protected $maxAttempts = 4;

    public function __construct(OAuthHeader $header, string $tokenUrl)
    {
        $this->header = $header;
        $this->tokenUrl = $tokenUrl;
        $this->client = new Client();
    }

    public function generate(): ?array
    {
        return $this->getAccessToken();
    }

    private function getAccessToken(): ?array
    {
        try {
            $this->attempts++;
            $response = $this->client->request('POST', $this->tokenUrl, [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
                'headers' => [
                    'Authorization' => $this->header->build(),
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $exception) {
            Log::error('Error generating HERE API OAuth token: ' . $exception->getMessage());
            return null;
        } catch (ServerException $exception) {
            Log::error('Error generating HERE API OAuth token: ' . $exception->getMessage());

            if ($this->attempts <= $this->maxAttempts) {
                return $this->getAccessToken();
            }

            throw new ErrorRetrievingHereApiToken;
        }
    }
}
