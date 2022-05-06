<?php

namespace Ianriizky\TalentaApi\Tests\Api;

use Ianriizky\TalentaApi\Support\Facades\TalentaApi;
use Ianriizky\TalentaApi\Tests\ApiTestCase;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;

/**
 * @see \Ianriizky\TalentaApi\Services\Api\Employee
 */
class CostCenterTest extends ApiTestCase
{
    public function test_getCostCenterReport_response_200()
    {
        $jsonPath = 'cost_center/getCostCenterReport/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getCostCenterReport([
            'user_id' => '571919',
            'year' => '2021',
            'month' => '8',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getCostCenterReport_response_200_with_filter()
    {
        $jsonPath = 'cost_center/getCostCenterReport/200_with_filter.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getCostCenterReport([
            'user_id' => '571919',
            'year' => '2021',
            'month' => '8',
            'payment_schedule_id' => '2475',
            'cost_center_id' => '71',
            // 'week' => '',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getCostCenterReport_response_400_error_validation_month_required()
    {
        $jsonPath = 'cost_center/getCostCenterReport/400_error_validation_month_required.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getCostCenterReport([
                'user_id' => '571919',
                'year' => '2021',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getCostCenterReport_response_400_error_company_sap_integration()
    {
        $jsonPath = 'cost_center/getCostCenterReport/400_error_company_sap_integration.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getCostCenterReport([
                'user_id' => '571919',
                'year' => '2021',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getCompanyCostCenter_response_200()
    {
        $jsonPath = 'cost_center/getCompanyCostCenter/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getCompanyCostCenter('3053', [
            'limit' => '10',
            'page' => '1',
            'user_id' => '988152',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getCompanyCostCenter_response_400()
    {
        $jsonPath = 'cost_center/getCompanyCostCenter/400.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getCompanyCostCenter('3053', [
                'limit' => '1000',
                'page' => '1',
                'user_id' => '988152x',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getCompanyCostCenter_response_401()
    {
        $jsonPath = 'cost_center/getCompanyCostCenter/401.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_UNAUTHORIZED);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_UNAUTHORIZED);

        try {
            TalentaApi::getCompanyCostCenter('3053', [
                'limit' => '10',
                'page' => '1',
                'user_id' => '988152',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }
}
