<?php

namespace Ianriizky\TalentaApi\Tests\Api;

use Ianriizky\TalentaApi\Support\Facades\TalentaApi;
use Ianriizky\TalentaApi\Tests\ApiTestCase;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\UploadedFile;

/**
 * @see \Ianriizky\TalentaApi\Services\Api\Employee
 */
class EmployeeTest extends ApiTestCase
{
    public function test_postAddEmployee_response_200()
    {
        $jsonPath = 'employee/postAddEmployee/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::postAddEmployee(json_decode(static::getJsonFromRequestsPath($jsonPath), true)), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_postAddEmployee_response_400_already_exists()
    {
        $jsonPath = 'employee/postAddEmployee/400_already_exists.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::postAddEmployee(json_decode(static::getJsonFromRequestsPath($jsonPath), true));
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_postAddEmployee_response_401()
    {
        $jsonPath = 'employee/postAddEmployee/401.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_UNAUTHORIZED);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_UNAUTHORIZED);

        try {
            TalentaApi::postAddEmployee(json_decode(static::getJsonFromRequestsPath($jsonPath), true));
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_postAddEmployee_response_400_invalid_input()
    {
        $jsonPath = 'employee/postAddEmployee/400_invalid_input.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::postAddEmployee(json_decode(static::getJsonFromRequestsPath($jsonPath), true));
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_postAddEmployee_response_400_exceed_company_limit()
    {
        $jsonPath = 'employee/postAddEmployee/400_exceed_company_limit.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::postAddEmployee(json_decode(static::getJsonFromRequestsPath($jsonPath), true));
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

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

    public function test_patchEmployee_response_401()
    {
        $jsonPath = 'employee/patchEmployee/401.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_UNAUTHORIZED);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_UNAUTHORIZED);

        try {
            TalentaApi::patchEmployee('936716', json_decode(static::getJsonFromRequestsPath($jsonPath), true));
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_patchEmployee_response_400()
    {
        $jsonPath = 'employee/patchEmployee/400.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::patchEmployee('936716', json_decode(static::getJsonFromRequestsPath($jsonPath), true));
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

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

    public function test_postEmployeeInformalEducation_response_200_with_uploaded_file()
    {
        $jsonPath = 'employee/postEmployeeInformalEducation/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::postEmployeeInformalEducation(
            json_decode(static::getJsonFromRequestsPath($jsonPath), true),
            [
                [
                    'name' => 'file',
                    'contents' => UploadedFile::fake()->image('file.png'),
                ],
            ],
        ), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
        $this->factory->assertSent(function (Request $request) {
            return $request->hasFile('file');
        });
    }

    public function test_postEmployeeInformalEducation_response_400_empty_request()
    {
        $jsonPath = 'employee/postEmployeeInformalEducation/400_empty_request.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::postEmployeeInformalEducation(json_decode(static::getJsonFromRequestsPath($jsonPath), true));
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_postEmployeeInformalEducation_response_400_user_doesnt_exists()
    {
        $jsonPath = 'employee/postEmployeeInformalEducation/400_user_doesnt_exists.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::postEmployeeInformalEducation(json_decode(static::getJsonFromRequestsPath($jsonPath), true));
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_postEmployeeInformalEducation_response_400_startdate_shoud_not_be_later_than_enddate()
    {
        $jsonPath = 'employee/postEmployeeInformalEducation/400_startdate_shoud_not_be_later_than_enddate.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::postEmployeeInformalEducation(json_decode(static::getJsonFromRequestsPath($jsonPath), true));
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_patchEmployeeInformalEducation_response_200()
    {
        $jsonPath = 'employee/patchEmployeeInformalEducation/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::patchEmployeeInformalEducation('3180', json_decode(static::getJsonFromRequestsPath($jsonPath), true)), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
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

    public function test_getEmployeeInformalEducation_response_400()
    {
        $jsonPath = 'employee/getEmployeeInformalEducation/400.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getEmployeeInformalEducation('57191921');
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

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
