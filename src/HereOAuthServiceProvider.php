<?php

namespace Laralabs\HereOAuth;

use Illuminate\Support\ServiceProvider;
use Laralabs\HereOAuth\Cache\Manager;
use Laralabs\HereOAuth\Factories\HereOAuthToken;
use Laralabs\HereOAuth\Factories\OAuthHeader;

class HereOAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/here-oauth.php',
            'here-oauth'
        );

        $this->registerBindings();
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/here-oauth.php'  => config_path('here-oauth.php'),
        ], 'config');
    }

    private function registerBindings(): void
    {
        $this->app->singleton(HereOAuth::class, static function ($app): HereOAuth {
            return new HereOAuth(
                $app->make(Manager::class)
            );
        });

        $this->app->singleton(OAuthHeader::class, static function (): OAuthHeader {
            return new OAuthHeader(
                config('here-oauth.access_key_id'),
                config('here-oauth.access_key_secret'),
                config('here-oauth.token_url')
            );
        });

        $this->app->singleton(HereOAuthToken::class, static function (): HereOAuthToken {
            return new HereOAuthToken(
                app(OAuthHeader::class),
                config('here-oauth.token_url')
            );
        });
    }
}
