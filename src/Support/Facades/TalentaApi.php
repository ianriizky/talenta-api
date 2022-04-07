<?php

namespace Ianriizky\TalentaApi\Support\Facades;

use Ianriizky\TalentaApi\Services\TalentaApi as Service;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Ianriizky\TalentaApi\Services\TalentaApi
 */
class TalentaApi extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return Service::class;
    }
}
