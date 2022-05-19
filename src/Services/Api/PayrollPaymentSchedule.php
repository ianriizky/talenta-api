<?php

namespace Ianriizky\TalentaApi\Services\Api;

use Illuminate\Http\Client\Response;

/**
 * @property \Illuminate\Http\Client\PendingRequest $request
 *
 * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#561cc8c8-403f-46c7-b12f-6f3e3922a47c
 */
trait PayrollPaymentSchedule
{
    /**
     * Create "/company/me/payroll-payment-schedule" GET request to the Talenta api.
     *
     * Get company payroll payment schedule. This endpoint will allow user to:
     * - get company payroll payment schedule master data
     * - get company payroll payment schedule transaction data with additonal year, month, status parameters
     *
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#52ffb3a7-5ea9-401f-a3db-a488e6546eb4
     */
    protected function getCompanyPayrollPaymentSchedule($query = null): Response
    {
        return $this->request->get('/company/me/payroll-payment-schedule', $query);
    }

    /**
     * Create "/payroll-payment-schedule/:company_id/history" GET request to the Talenta api.
     *
     * Get company payroll payment schedule. This endpoint will allow user to
     * - get company payroll payment schedule master data
     * - get company payroll payment schedule transaction data with additonal year, month, status parameters
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#0835590c-7454-4377-9419-7dacdd2073ef
     */
    protected function getPayrollPaymentScheduleHistory(string $company_id, $query = null): Response
    {
        return $this->request->get('/payroll-payment-schedule/'.$company_id.'/history', $query);
    }
}
