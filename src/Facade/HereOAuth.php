<?php

namespace Laralabs\HereOAuth\Facade;

use Illuminate\Support\Facades\Facade;

class HereOAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Laralabs\HereOAuth\HereOAuth::class;
    }
}
