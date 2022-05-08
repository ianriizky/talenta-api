<?php

namespace Ianriizky\TalentaApi\Services;

use BadMethodCallException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Macroable;
use RuntimeException;

/**
 * @see \Ianriizky\TalentaApi\Services\Api\AccessRole
 *
 * @method \Illuminate\Http\Client\Response getAccessRoleByUserID(string $super_admin_id, array|string|null $query = null) Create "/access-role/:super_admin_id" GET request to the Talenta api.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\Company
 *
 * @method \Illuminate\Http\Client\Response getBranch(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/branch" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getOrganization(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/organization" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getJobLevel(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/job-level" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getEmploymentStatus(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/employment-status" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getJobPosition(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/job-position" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getPersonalData(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/personal" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getCustomField(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/custom-field" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getConsultant(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/consultant" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getAccessRole(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/access-role" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getBankList(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/bank-list" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getBreakData(string $company_id = 'me', array|string|null $query = null) Create "/company/:company_id/break" GET request to the Talenta api.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\CostCenter
 *
 * @method \Illuminate\Http\Client\Response getCostCenterReport(array|string|null $query = null) Create "/cost-center" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getCompanyCostCenter(string $cost_center_id, array|string|null $query = null) Create "/company/:cost_center_id/cost-center" GET request to the Talenta api.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\Employee
 *
 * @method \Illuminate\Http\Client\Response postAddEmployee(array $data = []) Create "/employee" POST request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getEmployeeByUserID(string $employee_id, array|string|null $query = null) Create "/employee/:employee_id" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getAllEmployee(array|string|null $query = null) Create "/employee" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getEmployeeOnLeaveStatusByID(string $employee_id, array|string|null $query = null) Create "/employee/:employee_id/status" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response patchEmployee(string $user_id, array $data = []) Create "/employee/:user_id" PATCH request to the Talenta api.
 * @method \Illuminate\Http\Client\Response postEmployeeInformalEducation(array $data = []) Create "/employee/informal-education/create" POST request to the Talenta api.
 * @method \Illuminate\Http\Client\Response patchEmployeeInformalEducation(string $informal_education_id, array $data = []) Create "/employee/informal-education/:informal_education_id/update" PATCH request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getEmployeeInformalEducation(string $user_id, array $data = []) Create "/employee/informal-education/:user_id/list" GET request to the Talenta api.
 * @method \Illuminate\Http\Client\Response getEmployeeInformalEducationDetail(string $user_id, string $informal_education_id, array $data = []) Create "/employee/informal-education/:user_id/detail/:informal_education_id" GET request to the Talenta api.
 *
 * @see \Ianriizky\TalentaApi\Services\Api\Report
 *
 * @method \Illuminate\Http\Client\Response getTurnoverReport(string $user_id, array|string|null $query = null) Create "/report/:user_id/turnover" GET request to the Talenta api.
 *
 * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1
 */
class TalentaApi
{
    use Macroable {
        __call as macroCall;
    }
    use Api\AccessRole;
    use Api\Company;
    use Api\CostCenter;
    use Api\Employee;
    use Api\Report;
    use Concerns\HandleAuthentication;
    use Concerns\HandleHTTPClient;

    /**
     * List of escaped method when __call() is called.
     *
     * @var array<int, string>
     */
    protected static $escapedMethods = [
        'sendRequestToTalenta',
        'authenticateRequest',
        'createAuthenticationRequestHeader',
        'retryRequestWhenUnauthorized',
        'createRequestInstance',
        'createFreshRequestInstance',
        'parseBaseUrl',
    ];

    /**
     * @var \Ianriizky\TalentaApi\Http\Client\PendingRequest
     */
    protected $request;

    /**
     * List of config value.
     *
     * @var array
     */
    protected $config;

    /**
     * Create a new instance class.
     *
     * @param  array  $config
     * @param  string|bool|null  $sslVerify
     * @return void
     */
    public function __construct(array $config, $sslVerify = null)
    {
        $this->config = $config;

        $this->request = $this->createRequestInstance(
            $this->config['base_url'],
            $sslVerify,
            Arr::except($config['guzzle_options'], 'verify')
        );

        $this->request->beforeSending($this->authenticateRequest());

        $this->request->retry(
            $config['request_retry_times'],
            $config['request_retry_sleep'],
            $this->retryRequestWhenUnauthorized(),
            true
        );
    }

    /**
     * Send a request to the Talenta api based on the given method and parameters.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    protected function sendRequestToTalenta(string $method, array $parameters = []): Response
    {
        $response = $this->{$method}(...$parameters);

        if (! $response instanceof Response) {
            throw new RuntimeException(sprintf(
                'The return value from method %s::%s must be an instance of %s class.',
                static::class, $method, Response::class
            ));
        }

        // Use throw() method to make sure that it's always throw an exception
        // when the given response is error.
        return $response->throw();
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        if (in_array($method, static::$escapedMethods, true)) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s is in the escaped method list.', static::class, $method
            ));
        }

        return $this->sendRequestToTalenta($method, $parameters);
    }
}
