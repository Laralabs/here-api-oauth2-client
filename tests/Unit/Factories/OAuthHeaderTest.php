<?php

namespace Laralabs\HereOAuth\Tests\Unit\Factories;

use Carbon\Carbon;
use Laralabs\HereOAuth\Exceptions\InvalidHereApiAccessId;
use Laralabs\HereOAuth\Exceptions\InvalidHereApiAccessSecret;
use Laralabs\HereOAuth\Factories\OAuthHeader;
use Laralabs\HereOAuth\Tests\Fakes\Factories\FakeOAuthHeader;
use Laralabs\HereOAuth\Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class OAuthHeaderTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @var FakeOAuthHeader
     */
    protected $header;

    protected function setUp(): void
    {
        parent::setUp();

        $this->swap(
            OAuthHeader::class,
            new FakeOAuthHeader('1234', '1234', config('here-oauth.token_url'))
        );
        $this->header = app(OAuthHeader::class);
    }

    /** @test */
    public function it_throws_an_access_id_exception_if_not_set(): void
    {
        $this->assertNotNull(config('here-oauth.access_key_id'));
        $this->assertNotNull(config('here-oauth.access_key_secret'));

        $this->expectException(InvalidHereApiAccessId::class);

        config()->set('here-oauth.access_key_id', null);

        new OAuthHeader(
            config('here-oauth.access_key_id'),
            config('here-oauth.access_key_secret'),
            config('here-oauth.token_url')
        );
    }

    /** @test */
    public function it_throws_an_access_secret_exception_if_not_set(): void
    {
        $this->assertNotNull(config('here-oauth.access_key_id'));
        $this->assertNotNull(config('here-oauth.access_key_secret'));

        $this->expectException(InvalidHereApiAccessSecret::class);

        config()->set('here-oauth.access_key_secret', null);

        new OAuthHeader(
            config('here-oauth.access_key_id'),
            config('here-oauth.access_key_secret'),
            config('here-oauth.token_url')
        );
    }

    /** @test */
    public function it_can_get_a_nonce_value(): void
    {
        $nonce = $this->header->getNonce();

        $this->assertSame(strlen($nonce), 16);
    }

    /** @test */
    public function it_can_get_the_correct_signature_method_value(): void
    {
        $signatureMethod = $this->header->getSignatureMethod();

        $this->assertEquals('HMAC-SHA256', $signatureMethod);
    }

    /** @test */
    public function it_can_get_the_correct_timestamp_value(): void
    {
        Carbon::setTestNow('16-03-2020 13:00');

        $timestamp = $this->header->getTimestamp();

        $this->assertEquals('16-03-2020 13:00', Carbon::parse($timestamp)->format('d-m-Y H:i'));
    }

    /** @test */
    public function it_can_get_the_correct_oauth_signature_version(): void
    {
        $version = $this->header->getOAuthVersion();

        $this->assertEquals('1.0', $version);
    }

    /** @test */
    public function it_can_get_the_correct_http_method(): void
    {
        $version = $this->header->getHttpMethod();

        $this->assertEquals('POST', $version);
    }

    /** @test */
    public function it_generates_a_consistent_oauth_header(): void
    {
        Carbon::setTestNow('16-03-2020 13:00');

        $this->assertMatchesSnapshot($this->header->build());
    }
}
