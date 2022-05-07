<?php

namespace Ianriizky\TalentaApi\Tests\Api;

use Ianriizky\TalentaApi\Support\Facades\TalentaApi;
use Ianriizky\TalentaApi\Tests\ApiTestCase;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;

/**
 * @see \Ianriizky\TalentaApi\Services\Api\Company
 */
class CompanyTest extends ApiTestCase
{
    public function test_getBranch_response_200()
    {
        $jsonPath = 'company/getBranch/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getBranch(), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getOrganization_response_200()
    {
        $jsonPath = 'company/getOrganization/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getOrganization(), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getOrganization_response_200_with_pagination()
    {
        $jsonPath = 'company/getOrganization/200_with_pagination.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getOrganization('me', [
            'limit' => '3',
            'page' => '1',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getOrganization_response_200_invalid_branch_id()
    {
        $jsonPath = 'company/getOrganization/200_invalid_branch_id.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getOrganization('me', [
            'branch_id' => '11',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getJobLevel_response_200()
    {
        $jsonPath = 'company/getJobLevel/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getJobLevel(), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getJobLevel_response_200_with_pagination()
    {
        $jsonPath = 'company/getJobLevel/200_with_pagination.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getJobLevel('me', [
            'page' => '1',
            'limit' => '2',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getEmploymentStatus_response_200()
    {
        $jsonPath = 'company/getEmploymentStatus/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getEmploymentStatus(), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getEmploymentStatus_response_200_with_pagination()
    {
        $jsonPath = 'company/getEmploymentStatus/200_with_pagination.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getEmploymentStatus('me', [
            'page' => '1',
            'limit' => '2',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getJobPosition_response_200()
    {
        $jsonPath = 'company/getJobPosition/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getJobPosition('me', [
            // 'limit' => '10',
            // 'page' => '1',
            // 'branch_id' => '',
            'parent_id' => '21351',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getJobPosition_response_200_with_pagination()
    {
        $jsonPath = 'company/getJobPosition/200_with_pagination.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getJobPosition('me', [
            'limit' => '10',
            'page' => '1',
            // 'branch_id' => '',
            // 'parent_id' => '21351',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getJobPosition_response_200_not_found()
    {
        $jsonPath = 'company/getJobPosition/200_not_found.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getJobPosition('me', [
            'limit' => '10',
            'page' => '1',
            // 'branch_id' => '',
            'parent_id' => '213510',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getJobPosition_response_400()
    {
        $jsonPath = 'company/getJobPosition/400.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getJobPosition('me', [
                'limit' => '0',
                'page' => 'A',
                'branch_id' => '12CD',
                'parent_id' => '-1',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getPersonalData_response_200()
    {
        $jsonPath = 'company/getPersonalData/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getPersonalData('me', [
            'user_id' => '571919',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getPersonalData_response_200_with_pagination()
    {
        $jsonPath = 'company/getPersonalData/200_with_pagination.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getPersonalData('me', [
            'user_id' => '571919',
            'limit' => '5',
            'page' => '1',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getPersonalData_response_400_user_doesnt_exists()
    {
        $jsonPath = 'company/getPersonalData/400_user_doesnt_exists.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getPersonalData('me', [
                'user_id' => '57191900',
                'limit' => '5',
                'page' => '1',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getCustomField_response_200()
    {
        $jsonPath = 'company/getCustomField/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getCustomField(), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getConsultant_response_200_with_pagination()
    {
        $jsonPath = 'company/getConsultant/200_with_pagination.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getConsultant('me', [
            'page' => '1',
            'limit' => '10',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getConsultant_response_200_not_found()
    {
        $jsonPath = 'company/getConsultant/200_not_found.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getConsultant('me', [
            // 'page' => '1',
            // 'limit' => '5',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getConsultant_response_400()
    {
        $jsonPath = 'company/getConsultant/400.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getConsultant('me', [
                'page' => '1X',
                'limit' => '500',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getAccessRole_response_200_with_pagination()
    {
        $jsonPath = 'company/getAccessRole/200_with_pagination.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getAccessRole('me', [
            // 'limit' => '10',
            // 'page' => '1',
            // 'query' => '',
            // 'roleType' => '',
            // 'role' => '',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getAccessRole_response_400()
    {
        $jsonPath = 'company/getAccessRole/400.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getAccessRole('me', [
                'limit' => '10-',
                'page' => '0',
                'query' => 'AB',
                'roleType' => 'prompt',
                'role' => 'pegawai',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getAccessRole_response_400_invalid_company_id()
    {
        $jsonPath = 'company/getAccessRole/400_invalid_company_id.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getAccessRole('-670', [
                // 'limit' => '10',
                // 'page' => '0',
                // 'query' => 'AB',
                'roleType' => 'custom',
                // 'role' => 'pegawai',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getBankList_response_200()
    {
        $jsonPath = 'company/getBankList/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getBankList(), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getBankList_response_200_with_pagination()
    {
        $jsonPath = 'company/getBankList/200_with_pagination.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getBankList('me', [
            'page' => '1',
            'limit' => '10',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getBreakData_response_200_with_pagination()
    {
        $jsonPath = 'company/getBreakData/200_with_pagination.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getBreakData(), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }
}
