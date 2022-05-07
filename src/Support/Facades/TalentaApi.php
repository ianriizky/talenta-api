<?php

namespace Ianriizky\TalentaApi\Support\Facades;

use Ianriizky\TalentaApi\Services\TalentaApi as Service;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Ianriizky\TalentaApi\Services\Concerns\HandleAuthentication
 * @method static string createAuthenticationSignature(\Illuminate\Support\Carbon $date, string|\Psr\Http\Message\RequestInterface $request, string $hmacSecret) Create authentication signature using sha256 hash and base64 encoding.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\AccessRole
 * @method static \Illuminate\Http\Client\Response getAccessRoleByUserID(string $super_admin_id, array|string|null $query = null) Create "/access-role/:super_admin_id" GET request to the Talenta api.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\CostCenter
 * @method static \Illuminate\Http\Client\Response getCostCenterReport(array|string|null $query = null) Create "/cost-center" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getCompanyCostCenter(string $cost_center_id, array|string|null $query = null) Create "/company/:cost_center_id/cost-center" GET request to the Talenta api.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\Employee
 * @method static \Illuminate\Http\Client\Response addEmployee(array $data = []) Create "/employee" POST request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getEmployeeByUserID(string $employee_id, array|string|null $query = null) Create "/employee/:employee_id" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getAllEmployee(array|string|null $query = null) Create "/employee" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getEmployeeOnLeaveStatusByID(string $employee_id, array|string|null $query = null) Create "/employee/:employee_id/status" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response patchEmployee(string $user_id, array $data = []) Create "/employee/:user_id" PATCH request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response postEmployeeInformalEducation(array $data = []) Create "/employee/informal-education/create" POST request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response patchEmployeeInformalEducation(string $informal_education_id, array $data = []) Create "/employee/informal-education/:informal_education_id/update" PATCH request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getEmployeeInformalEducation(string $user_id, array $data = []) Create "/employee/informal-education/:user_id/list" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getEmployeeInformalEducationDetail(string $user_id, string $informal_education_id, array $data = []) Create "/employee/informal-education/:user_id/detail/:informal_education_id" GET request to the Talenta api.
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
