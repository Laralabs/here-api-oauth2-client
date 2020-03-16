<?php

namespace Laralabs\HereOAuth\Exceptions;

use InvalidArgumentException;

class InvalidHereApiAccessSecret extends InvalidArgumentException
{
    protected $message = 'The HERE API Access Secret is not a string, check the HERE_OAUTH_ACCESS_SECRET'
        . ' env variable is set';
}
