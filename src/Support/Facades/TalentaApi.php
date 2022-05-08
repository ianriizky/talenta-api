<?php

namespace Ianriizky\TalentaApi\Support\Facades;

use Ianriizky\TalentaApi\Services\TalentaApi as Service;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Ianriizky\TalentaApi\Services\Concerns\HandleAuthentication
 *
 * @method static string createAuthenticationSignature(\Illuminate\Support\Carbon $date, string|\Psr\Http\Message\RequestInterface $request, string $hmacSecret) Create authentication signature using sha256 hash and base64 encoding.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\AccessRole
 *
 * @method static \Illuminate\Http\Client\Response getAccessRoleByUserID(string $super_admin_id, array|string|null $query = null) Create "/access-role/:super_admin_id" GET request to the Talenta api.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\Company
 *
 * @method static \Illuminate\Http\Client\Response getBranch(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/branch" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getOrganization(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/organization" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getJobLevel(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/job-level" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getEmploymentStatus(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/employment-status" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getJobPosition(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/job-position" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getPersonalData(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/personal" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getCustomField(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/custom-field" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getConsultant(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/consultant" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getAccessRole(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/access-role" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getBankList(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/bank-list" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getBreakData(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/break" GET request to the Talenta api.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\CostCenter
 *
 * @method static \Illuminate\Http\Client\Response getCostCenterReport(array|string|null $query = null) Create "/cost-center" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getCompanyCostCenter(string $cost_center_id, array|string|null $query = null) Create "/company/:cost_center_id/cost-center" GET request to the Talenta api.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\Employee
 *
 * @method static \Illuminate\Http\Client\Response postAddEmployee(array $data = []) Create "/employee" POST request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getEmployeeByUserID(string $employee_id, array|string|null $query = null) Create "/employee/:employee_id" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getAllEmployee(array|string|null $query = null) Create "/employee" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getEmployeeOnLeaveStatusByID(string $employee_id, array|string|null $query = null) Create "/employee/:employee_id/status" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response patchEmployee(string $user_id, array $data = []) Create "/employee/:user_id" PATCH request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response postEmployeeInformalEducation(array $data = []) Create "/employee/informal-education/create" POST request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response patchEmployeeInformalEducation(string $informal_education_id, array $data = []) Create "/employee/informal-education/:informal_education_id/update" PATCH request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getEmployeeInformalEducation(string $user_id, array $data = []) Create "/employee/informal-education/:user_id/list" GET request to the Talenta api.
 * @method static \Illuminate\Http\Client\Response getEmployeeInformalEducationDetail(string $user_id, string $informal_education_id, array $data = []) Create "/employee/informal-education/:user_id/detail/:informal_education_id" GET request to the Talenta api.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\Report
 *
 * @method static \Illuminate\Http\Client\Response getTurnoverReport(string $user_id, array|string|null $query = null) Create "/report/:user_id/turnover" GET request to the Talenta api.
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
