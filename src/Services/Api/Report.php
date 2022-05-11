<?php

namespace Ianriizky\TalentaApi\Services\Api;

use Illuminate\Http\Client\Response;

/**
 * @property \Illuminate\Http\Client\PendingRequest $request
 *
 * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#41daef38-af9a-481c-b61f-78fe62092ffd
 */
trait Report
{
    /**
     * Create "/report/:user_id/turnover" GET request to the Talenta api.
     *
     * Fetch list of turnover report.
     *
     * @param  string  $user_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#61a3b2b9-38b3-4dee-8599-178fdf891d08
     */
    protected function getTurnoverReport(string $user_id, $query = null): Response
    {
        return $this->request->get('/report/'.$user_id.'/turnover', $query);
    }
}
