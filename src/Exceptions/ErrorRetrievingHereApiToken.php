<?php

namespace Laralabs\HereOAuth\Exceptions;

use RuntimeException;

class ErrorRetrievingHereApiToken extends RuntimeException
{
    protected $message = 'Unable to retrieve a HERE API OAuth access token, max attempts exceeded, check logs for more'
        . ' information';
}
