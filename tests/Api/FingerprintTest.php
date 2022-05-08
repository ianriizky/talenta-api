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
 * @see \Ianriizky\TalentaApi\Services\Api\Fingerprint
 */
class FingerprintTest extends ApiTestCase
{
    public function test_postAttendanceImportFingerprint_response_200()
    {
        $jsonPath = 'fingerprint/postAttendanceImportFingerprint/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::postAttendanceImportFingerprint([
            'user_id' => '571919',
            'token' => '9b12964f1f03e7b0de26be6a68dcdd56',
        ], [
            [
                'fingerprint',
                UploadedFile::fake()->create('fingerprint.csv'),
            ],
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
        $this->factory->assertSent(function (Request $request) {
            return $request->hasFile('fingerprint');
        });
    }

    public function test_postAttendanceImportFingerprint_response_400_automatic_import_attendance_not_exists()
    {
        $jsonPath = 'fingerprint/postAttendanceImportFingerprint/400_automatic_import_attendance_not_exists.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::postAttendanceImportFingerprint([
                'user_id' => '571919',
                'token' => '9b12964f1f03e7b0de26be6a68dcdd56',
            ], [
                [
                    'fingerprint',
                    UploadedFile::fake()->create('fingerprint.csv'),
                ],
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
        $this->factory->assertSent(function (Request $request) {
            return $request->hasFile('fingerprint');
        });
    }
}
