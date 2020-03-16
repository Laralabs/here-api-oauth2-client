<?php

namespace Laralabs\HereOAuth\Tests;

use Laralabs\HereOAuth\HereOAuthServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array // phpcs:ignore
    {
        return [
            HereOAuthServiceProvider::class,
        ];
    }
}
