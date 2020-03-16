<?php

namespace Laralabs\HereOAuth\Exceptions;

use InvalidArgumentException;

class InvalidHereApiAccessId extends InvalidArgumentException
{
    protected $message = 'The HERE API Access ID is not a string, check the HERE_OAUTH_ACCESS_ID env variable is set';
}
