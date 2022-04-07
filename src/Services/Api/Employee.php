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
     */
    protected function getAllEmployee($query = null): Response
    {
        return $this->request->get('/employee', $query);
    }
}
