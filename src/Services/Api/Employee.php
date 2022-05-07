<?php

namespace Ianriizky\TalentaApi\Services\Api;

use Illuminate\Http\Client\Response;

/**
 * @property \Ianriizky\TalentaApi\Http\Client\PendingRequest $request
 *
 * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#f70ad8ab-3921-49d1-bdb0-a3195c5bdc02
 */
trait Employee
{
    /**
     * Create "/employee" POST request to the Talenta api.
     *
     * Add / Insert a new user to Talenta system.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#4300f164-4a59-415b-bb6e-d141ba14cd38
     */
    protected function addEmployee(array $data = []): Response
    {
        return $this->request->post('/employee', $data);
    }

    /**
     * Create "/employee/:employee_id" GET request to the Talenta api.
     *
     * Fetch the detailed information of a certain employee who has
     * been registered in Talenta system. user_id refers to the
     * unique identifier of the Talenta user.
     *
     * @param  string  $employee_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#c4c70b1b-a54f-4d90-aff3-a8da6dac34d9
     */
    protected function getEmployeeByUserID(string $employee_id, $query = null): Response
    {
        return $this->request->get('/employee/'.$employee_id, $query);
    }

    /**
     * Create "/employee" GET request to the Talenta api.
     *
     * This API returns the list of employees and its details. This API data response
     * uses the same structure from the Get Employee Details API’s
     * data object in previous part.
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

    /**
     * Create "/employee/:employee_id/status" GET request to the Talenta api.
     *
     * Get current on-leave status with certain user_id.
     *
     * @param  string  $employee_id
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#d2f7c6e0-638c-4bb9-b50b-167ef6a1cce8
     */
    protected function getEmployeeOnLeaveStatusByID(string $employee_id, $query = null): Response
    {
        return $this->request->get('/employee/'.$employee_id.'/status', $query);
    }

    /**
     * Create "/employee/:user_id" PATCH request to the Talenta api.
     *
     * Update the existing employee data in Talenta system.
     * At this version, this API is limited to user
     * personal and company related information.
     *
     * @param  string  $user_id
     * @param  array  $data
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#71c51f09-73ed-4d4d-bb00-ba26953dc7ae
     */
    protected function patchEmployee(string $user_id, array $data = []): Response
    {
        return $this->request->patch('/employee/'.$user_id, $data);
    }

    /**
     * Create "/employee/informal-education/create" POST request to the Talenta api.
     *
     * Submit Employee Informal Education Request.
     *
     * @param  array  $data
     * @param  string|resource|null  $file
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#f127d103-9114-4e57-8da8-735040ca7a98
     */
    protected function postEmployeeInformalEducation(array $data = [], $file = null): Response
    {
        if (! is_null($file)) {
            $this->request->attach('file', $file);
        }

        return $this->request->post('/employee/informal-education/create', $data);
    }

    /**
     * Create "/employee/informal-education/:informal_education_id/update" PATCH request to the Talenta api.
     *
     * Update Employee Informal Education Request.
     *
     * @param  string  $informal_education_id
     * @param  array  $data
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#bc27a6c8-9925-4ad4-a096-878ed228b260
     */
    protected function patchEmployeeInformalEducation(string $informal_education_id, array $data = []): Response
    {
        return $this->request->patch('/employee/informal-education/'.$informal_education_id.'/update', $data);
    }

    /**
     * Create "/employee/informal-education/:user_id/list" GET request to the Talenta api.
     *
     * Update Employee Informal Education Request.
     *
     * @param  string  $user_id
     * @param  array  $data
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#8e5592ae-3652-4b96-b700-f970a62bd418
     */
    protected function getEmployeeInformalEducation(string $user_id, array $data = []): Response
    {
        return $this->request->get('/employee/informal-education/'.$user_id.'/list', $data);
    }

    /**
     * Create "/employee/informal-education/:user_id/detail/:informal_education_id" GET request to the Talenta api.
     *
     * Update Employee Informal Education Request.
     *
     * @param  string  $user_id
     * @param  string  $informal_education_id
     * @param  array  $data
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#18028998-1dcf-4cc8-b7fc-630f56bb1a50
     */
    protected function getEmployeeInformalEducationDetail(string $user_id, string $informal_education_id, array $data = []): Response
    {
        return $this->request->get('/employee/informal-education/'.$user_id.'/detail/'.$informal_education_id, $data);
    }
}
