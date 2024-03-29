<?php

namespace Laralabs\HereOAuth\Factories;

use Illuminate\Support\Str;
use Laralabs\HereOAuth\Exceptions\InvalidHereApiAccessId;
use Laralabs\HereOAuth\Exceptions\InvalidHereApiAccessSecret;

class OAuthHeader
{
    protected string $accessId;

    protected string $accessSecret;

    protected ?OAuthHeader $header = null;

    protected string $tokenUrl;

    protected string $nonce;

    protected string $signatureMethod = 'HMAC-SHA256';

    protected string $version = '1.0';

    protected string $httpMethod = 'POST';

    protected string $baseString = '';

    protected array $parameters = [];

    protected string $paramString = '';

    protected string $headerString = '';

    public function __construct(?string $accessId, ?string $accessSecret, string $tokenUrl)
    {
        throw_if($accessId === null, new InvalidHereApiAccessId);
        throw_if($accessSecret === null, new InvalidHereApiAccessSecret);

        $this->accessId = $accessId;
        $this->accessSecret = $accessSecret;
        $this->tokenUrl = $tokenUrl;
        $this->nonce = Str::random(16);
    }

    public function build(): string
    {
        $this->appendMethodAndUrlToBaseString();
        $this->buildOAuthParameters();
        $this->buildParamString();
        $this->buildAndAppendSignature();

        return $this->buildHeaderString();
    }

    private function appendMethodAndUrlToBaseString(): void
    {
        $this->baseString = $this->httpMethod . '&' . urlencode($this->tokenUrl);
    }

    private function buildOAuthParameters(): void
    {
        $this->parameters = [
            'oauth_consumer_key' => $this->accessId,
            'oauth_nonce' => $this->getNonce(),
            'oauth_signature_method' => $this->getSignatureMethod(),
            'oauth_timestamp' => $this->getTimestamp(),
            'oauth_version' => $this->getOAuthVersion(),
        ];
    }

    private function buildParamString(): void
    {
        $this->paramString = 'grant_type=client_credentials';

        foreach ($this->parameters as $key => $value) {
            $this->paramString .= '&' . $key . '=' . urlencode($value);
        }
    }

    private function buildAndAppendSignature(): void
    {
        $this->parameters['oauth_signature'] = $this->buildSignature(
            $this->baseString . '&' . urlencode($this->paramString),
            urlencode($this->accessSecret) . '&'
        );
    }

    private function buildSignature(string $baseString, string $signingKey): string
    {
        return urlencode(
            base64_encode(
                hash_hmac(
                    'sha256',
                    $baseString,
                    $signingKey,
                    true
                )
            )
        );
    }

    private function buildHeaderString(): string
    {
        $separator = '';

        foreach ($this->parameters as $key => $value) {
            $this->headerString .= $separator . $key . '="' . $value . '"';
            $separator = ',';
        }

        return 'OAuth ' . $this->headerString;
    }

    public function getNonce(): string
    {
        return $this->nonce;
    }

    public function getSignatureMethod(): string
    {
        return $this->signatureMethod;
    }

    public function getTimestamp(): int
    {
        return now()->timestamp;
    }

    public function getOAuthVersion(): string
    {
        return $this->version;
    }

    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }
}
