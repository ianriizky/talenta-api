<?php

namespace Ianriizky\TalentaApi\Services\Api;

use Illuminate\Http\Client\Response;

/**
 * @property \Illuminate\Http\Client\PendingRequest $request
 *
 * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#f5dfd1f3-4cf6-4e55-85b1-c15a84f85518
 */
trait AccessRole
{
    /**
     * Create "/access-role/:super_admin_id" GET request to the Talenta api.
     *
     * Get access role by user id.
     *
     * @param  string  $super_admin_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#182a8292-8c45-425e-8ec9-02add83f1a70
     */
    protected function getAccessRoleByUserID(string $super_admin_id, $query = null): Response
    {
        return $this->request->get('/access-role/'.$super_admin_id, $query);
    }
}
