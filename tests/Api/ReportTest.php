<?php

namespace Ianriizky\TalentaApi\Tests\Api;

use Ianriizky\TalentaApi\Support\Facades\TalentaApi;
use Ianriizky\TalentaApi\Tests\ApiTestCase;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;

/**
 * @see \Ianriizky\TalentaApi\Services\Api\Report
 */
class ReportTest extends ApiTestCase
{
    public function test_getTurnoverReport_response_200()
    {
        $jsonPath = 'report/getTurnoverReport/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getTurnoverReport('571919', [
            'year' => '2021',
            'page' => '1',
            'limit' => '5',
            // 'branch_id' => '1',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getTurnoverReport_response_200_empty_response()
    {
        $jsonPath = 'report/getTurnoverReport/200_empty_response.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getTurnoverReport('935853', [
            'year' => '2021',
            'page' => '1',
            'limit' => '5',
            // 'branch_id' => '1',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getTurnoverReport_response_401()
    {
        $jsonPath = 'report/getTurnoverReport/401.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_UNAUTHORIZED);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_UNAUTHORIZED);

        try {
            TalentaApi::getTurnoverReport('935853', [
                'year' => '2021',
                'page' => '1',
                'limit' => '5',
                // 'branch_id' => '1',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getTurnoverReport_response_400()
    {
        $jsonPath = 'report/getTurnoverReport/400.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getTurnoverReport('935853', [
                'year' => '2021',
                'page' => '1',
                'limit' => '5',
                // 'branch_id' => '1',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }
}
