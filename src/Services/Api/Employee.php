<?php

namespace Ianriizky\TalentaApi\Services\Api;

use Illuminate\Http\Client\Response;

/**
 * @property \Illuminate\Http\Client\PendingRequest $request
 */
trait Employee
{
    /**
     * Create "/employee" GET request to the Talenta api.
     *
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#904b41dc-1d5f-4954-889f-f952f11c989a
     */
    protected function getAllEmployee($query = null): Response
    {
        return $this->request->get('/employee', $query);
    }
}
