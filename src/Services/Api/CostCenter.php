<?php

namespace Ianriizky\TalentaApi\Services\Api;

use Illuminate\Http\Client\Response;

/**
 * @property \Ianriizky\TalentaApi\Http\Client\PendingRequest $request
 *
 * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#ab263267-7251-41a7-aa23-53fc61d58370
 */
trait CostCenter
{
    /**
     * Create "/cost-center" GET request to the Talenta api.
     *
     * Get Cost Center report.
     *
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#f88530c7-082d-4c96-a3b4-2192525cc390
     */
    protected function getCostCenterReport($query = null): Response
    {
        return $this->request->get('/cost-center', $query);
    }

    /**
     * Create "/company/:cost_center_id/cost-center" GET request to the Talenta api.
     *
     * Get company cost center.
     *
     * @param  string  $cost_center_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#600b64a7-d39e-42af-9457-65dbd90fc93d
     */
    protected function getCompanyCostCenter(string $cost_center_id, $query = null): Response
    {
        return $this->request->get('/company/'.$cost_center_id.'/cost-center', $query);
    }
}
