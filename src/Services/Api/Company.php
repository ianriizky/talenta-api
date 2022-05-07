<?php

namespace Ianriizky\TalentaApi\Services\Api;

use Illuminate\Http\Client\Response;

/**
 * @property \Ianriizky\TalentaApi\Http\Client\PendingRequest $request
 *
 * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#3fd7ec86-54ac-44d4-aa79-585b8833c216
 */
trait Company
{
    /**
     * Create "/company/:company_id/branch" GET request to the Talenta api.
     *
     * Fetch branches information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#3d3bc37f-8d68-4666-99e0-ce92190423b6
     */
    protected function getBranch(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/branch', $query);
    }

    /**
     * Create "/company/:company_id/organization" GET request to the Talenta api.
     *
     * Fetch organization information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#60af6a75-c9e6-498d-925d-b4cfafedfd35
     */
    protected function getOrganization(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/organization', $query);
    }

    /**
     * Create "/company/:company_id/job-level" GET request to the Talenta api.
     *
     * Fetch job levels information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#5a98815e-4417-434d-bf39-e947b7896047
     */
    protected function getJobLevel(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/job-level', $query);
    }

    /**
     * Create "/company/:company_id/employment-status" GET request to the Talenta api.
     *
     * Fetch employment status information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#1fbfc7e6-d0e0-466a-bd60-b31da4757694
     */
    protected function getEmploymentStatus(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/employment-status', $query);
    }

    /**
     * Create "/company/:company_id/job-position" GET request to the Talenta api.
     *
     * Fetch job positions information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#d4f8e753-d74a-49b0-941f-9ca305dad834
     */
    protected function getJobPosition(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/job-position', $query);
    }

    /**
     * Create "/company/:company_id/personal" GET request to the Talenta api.
     *
     * Fetch Personal Data information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#4ccdd55f-88a5-4f00-b60a-fce8a490fd00
     */
    protected function getPersonalData(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/personal', $query);
    }

    /**
     * Create "/company/:company_id/custom-field" GET request to the Talenta api.
     *
     * Fetch custom field information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#a37ddefb-d6eb-40fd-bfd1-095ad988d16c
     */
    protected function getCustomField(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/custom-field', $query);
    }

    /**
     * Create "/company/:company_id/consultant" GET request to the Talenta api.
     *
     * Fetch consultants information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#e5b4991b-be58-4637-ba45-5fa2bb27ca7e
     */
    protected function getConsultant(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/consultant', $query);
    }

    /**
     * Create "/company/:company_id/access-role" GET request to the Talenta api.
     *
     * Fetch list of access role information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#98c94e04-7232-4d0a-8095-87fa1f60738f
     */
    protected function getAccessRole(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/access-role', $query);
    }

    /**
     * Create "/company/:company_id/bank-list" GET request to the Talenta api.
     *
     * Fetch bank list data information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#ea7a8526-8ee9-4b9b-b0b8-2b4539b11780
     */
    protected function getBankList(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/bank-list', $query);
    }

    /**
     * Create "/company/:company_id/break" GET request to the Talenta api.
     *
     * Fetch break data information for a certain company. The company identifier
     * will be passed through the HMAC authentication. This endpoint supports
     * pagination to limit the data.
     *
     * @param  string  $company_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#eb51a50c-9fca-42ae-a93f-ddb58c7fb888
     */
    protected function getBreakData(string $company_id = 'me', $query = null): Response
    {
        return $this->request->get('/company/'.$company_id.'/break', $query);
    }
}
