<?php

namespace Ianriizky\TalentaApi\Support\Facades;

use Ianriizky\TalentaApi\Http\Client\Factory;
use Illuminate\Support\Facades\Http as LaravelHttp;

class Http extends LaravelHttp
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
