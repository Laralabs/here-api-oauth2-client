<?php

namespace Laralabs\HereOAuth\Exceptions;

use RuntimeException;

class HereOAuthTokenExpired extends RuntimeException
{
    protected $message = 'The HERE API OAuth access token has expired from the cache';
}
