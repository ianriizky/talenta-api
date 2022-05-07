<?php

namespace Ianriizky\TalentaApi\Tests\Api;

use Ianriizky\TalentaApi\Support\Facades\TalentaApi;
use Ianriizky\TalentaApi\Tests\ApiTestCase;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;

/**
 * @see \Ianriizky\TalentaApi\Services\Api\AccessRole
 */
class AccessRoleTest extends ApiTestCase
{
    public function test_getAccessRoleByUserID_response_200()
    {
        $jsonPath = 'access_role/getAccessRoleByUserID/200.json';

        $this->factory->fakeUsingJsonPath($jsonPath);

        tap(TalentaApi::getAccessRoleByUserID('935853', [
            'user_id' => '935853',
        ]), function ($response) use ($jsonPath) {
            $this->assertInstanceOf(Response::class, $response);

            $response->assertSameWithJsonPath($jsonPath);
        });

        $this->factory->assertSentCount(1);
    }

    public function test_getAccessRoleByUserID_response_401()
    {
        $jsonPath = 'access_role/getAccessRoleByUserID/401.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_UNAUTHORIZED);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_UNAUTHORIZED);

        try {
            TalentaApi::getAccessRoleByUserID('93585312', [
                'user_id' => '935853',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }

    public function test_getAccessRoleByUserID_response_400()
    {
        $jsonPath = 'access_role/getAccessRoleByUserID/400.json';

        $this->factory->fakeUsingJsonPath($jsonPath, HttpResponse::HTTP_BAD_REQUEST);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(HttpResponse::HTTP_BAD_REQUEST);

        try {
            TalentaApi::getAccessRoleByUserID('-1231321', [
                'user_id' => '935853x',
            ]);
        } catch (RequestException $th) {
            $th->response->assertSameWithJsonPath($jsonPath);

            throw $th;
        }

        $this->factory->assertSentCount(1);
    }
}
