<?php

namespace Laralabs\HereOAuth\Tests\Fakes\Factories;

use Laralabs\HereOAuth\Factories\OAuthHeader;

class FakeOAuthHeader extends OAuthHeader
{
    public function getNonce(): string
    {
        return 'extraterrestrial';
    }
}
