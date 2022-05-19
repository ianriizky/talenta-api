<?php

namespace Ianriizky\TalentaApi\Tests\Api;

use Ianriizky\TalentaApi\Support\Facades\TalentaApi;
use Ianriizky\TalentaApi\Tests\ApiTestCase;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;

/**
 * @see \Ianriizky\TalentaApi\Services\Api\PayrollPaymentSchedule
 */
class PayrollPaymentScheduleTest extends ApiTestCase
{
    public function test_getCompanyPayrollPaymentSchedule_response_200_master_data_payroll_payment_schedule()
    {
        $jsonPath = 'payroll_payment_schedule/getCompanyPayrollPaymentSchedule/200_master_data_payroll_payment_schedule.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getCompanyPayrollPaymentSchedule([
            // 'limit' => 'x',
            // 'page' => '1x',
            'user_id' => '8002',
            // 'year' => '2021',
            // 'month' => 'x',
            // 'status' => 'pending',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getCompanyPayrollPaymentSchedule_response_200_payroll_payment_schedule_transaction()
    {
        $jsonPath = 'payroll_payment_schedule/getCompanyPayrollPaymentSchedule/200_payroll_payment_schedule_transaction.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getCompanyPayrollPaymentSchedule([
            // 'limit' => 'x',
            // 'page' => '1x',
            'user_id' => '8002',
            'year' => '2021',
            // 'month' => 'x',
            // 'status' => '',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getCompanyPayrollPaymentSchedule_response_200_empty_response()
    {
        $jsonPath = 'payroll_payment_schedule/getCompanyPayrollPaymentSchedule/200_empty_response.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getCompanyPayrollPaymentSchedule([
            // 'limit' => 'x',
            // 'page' => '1x',
            'user_id' => '935848',
            // 'year' => 'x',
            // 'month' => 'x',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getCompanyPayrollPaymentSchedule_response_401()
    {
        $jsonPath = 'payroll_payment_schedule/getCompanyPayrollPaymentSchedule/401.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_UNAUTHORIZED);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_UNAUTHORIZED);

        try {
            TalentaApi::getCompanyPayrollPaymentSchedule([
                // 'limit' => '3',
                // 'page' => '1',
                'user_id' => '935848',
                // 'year' => '',
                // 'month' => '',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getCompanyPayrollPaymentSchedule_response_400()
    {
        $jsonPath = 'payroll_payment_schedule/getCompanyPayrollPaymentSchedule/400.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getCompanyPayrollPaymentSchedule([
                'limit' => 'x',
                'page' => '1x',
                'user_id' => '-8002',
                'year' => '2021x',
                'month' => 'x',
                'status' => 'pending',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getPayrollPaymentScheduleHistory_response_200()
    {
        $jsonPath = 'payroll_payment_schedule/getPayrollPaymentScheduleHistory/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getPayrollPaymentScheduleHistory('me', [
            'limit' => '20',
            'page' => '1',
            'user_id' => '935848',
            // 'month' => '4',
            'year' => '2022',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getPayrollPaymentScheduleHistory_response_200_empty_data()
    {
        $jsonPath = 'payroll_payment_schedule/getPayrollPaymentScheduleHistory/200_empty_data.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getPayrollPaymentScheduleHistory('me', [
            'limit' => '20',
            'page' => '1',
            'user_id' => '935848',
            'month' => '12',
            'year' => '2022',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getPayrollPaymentScheduleHistory_response_400()
    {
        $jsonPath = 'payroll_payment_schedule/getPayrollPaymentScheduleHistory/400.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getPayrollPaymentScheduleHistory('me', [
                'limit' => '200',
                'page' => '1x',
                'user_id' => '935848',
                'month' => '12x',
                'year' => '2022x',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }
}
