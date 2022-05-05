<?php

namespace Ianriizky\TalentaApi\Support\Facades;

use Ianriizky\TalentaApi\Services\TalentaApi as Service;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string createAuthenticationSignature(\Illuminate\Support\Carbon $date, string|\Psr\Http\Message\RequestInterface $request, string $hmacSecret) Create authentication signature using sha256 hash and base64 encoding.
 * @method static \Illuminate\Http\Client\Response addEmployee(array $data = []) Create "/employee" POST request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getEmployeeByUserID(string $employee_id, array|string|null $query = null) Create "/employee/:employee_id" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getAllEmployee(array|string|null array|string|null $query = null) Create "/employee" GET request to the Talenta api.
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
