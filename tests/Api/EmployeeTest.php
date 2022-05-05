<?php

namespace Ianriizky\TalentaApi\Tests\Api;

use Ianriizky\TalentaApi\Support\Facades\TalentaApi;
use Ianriizky\TalentaApi\Tests\ApiTestCase;
use Illuminate\Http\Client\Response;

/**
 * @see \Ianriizky\TalentaApi\Services\Api\Employee
 */
class EmployeeTest extends ApiTestCase
{
    public function test_addEmployee_response_200()
    {
        $jsonPath = 'employee/addEmployee/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::addEmployee(json_decode(static::getJsonFromRequestsPath($jsonPath), true)), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getEmployeeByUserID_response_200()
    {
        $jsonPath = 'employee/getEmployeeByUserID/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getEmployeeByUserID('938081'), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getAllEmployee_response_200()
    {
        $jsonPath = 'employee/getAllEmployee/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getAllEmployee(), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getEmployeeOnLeaveStatusByID_response_200()
    {
        $jsonPath = 'employee/getEmployeeOnLeaveStatusByID/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getEmployeeOnLeaveStatusByID('935853'), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_patchEmployee_response_200()
    {
        $jsonPath = 'employee/patchEmployee/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::patchEmployee('936716', json_decode(static::getJsonFromRequestsPath($jsonPath), true)), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_postEmployeeInformalEducation_response_200()
    {
        $jsonPath = 'employee/postEmployeeInformalEducation/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::postEmployeeInformalEducation(json_decode(static::getJsonFromRequestsPath($jsonPath), true)), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_patchEmployeeInformalEducation_response_200()
    {
        $this->assertTrue(true);
    }

    public function test_getEmployeeInformalEducation_response_200()
    {
        $jsonPath = 'employee/getEmployeeInformalEducation/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getEmployeeInformalEducation('571919'), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getEmployeeInformalEducationDetail_response_200()
    {
        $jsonPath = 'employee/getEmployeeInformalEducationDetail/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getEmployeeInformalEducationDetail('935848', '3254'), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }
}
