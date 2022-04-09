<?php

namespace Ianriizky\TalentaApi\Support\Facades;

use Ianriizky\TalentaApi\Services\TalentaApi as Service;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Http\Client\Response getAllEmployee(array|string|null $query) Create "/employee" GET request to the Talenta api..
 *
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
