<?php

namespace Ianriizky\TalentaApi\Tests;

use Ianriizky\TalentaApi\Support\Facades\TalentaApi;
use Ianriizky\TalentaApi\Support\Facades\Http;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Testing\Assert;
use Mockery as m;

class ApiTestCase extends TestCase
{
    /**
     * @var \Ianriizky\TalentaApi\Http\Client\Factory
     */
    protected $factory;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = Http::getFacadeRoot();

        $this->factory->macro('responseFromJsonPath', function (string $jsonPath, $status = 200, $headers = []) {
            /** @var \Ianriizky\TalentaApi\Http\Client\Factory $factory */
            $factory = $this;
            $body = json_decode(ApiTestCase::getJsonFromResponsesPath($jsonPath), true);

            return $factory->response($body, $status, $headers);
        });

        $this->factory->macro('fakeUsingJsonPath', function (string $jsonPath, $status = 200, $headers = []) {
            /** @var \Ianriizky\TalentaApi\Http\Client\Factory $factory */
            $factory = $this;

            $factory->fake(function (Request $request) use ($factory, $jsonPath, $status, $headers) {
                Assert::assertTrue($request->hasTalentaAuthenticationHeader());

                return $factory->responseFromJsonPath($jsonPath, $status, $headers);
            });
        });

        Request::macro('hasTalentaAuthenticationHeader', function () {
            /** @var \Illuminate\Http\Client\Request $request */
            $request = $this;

            if (! $request->hasHeader('Authorization') ||
                ! $request->hasHeader('Date') ||
                ! Carbon::hasFormat($request->header('Date')[0], Carbon::RFC7231_FORMAT)) {
                return false;
            }

            $authorization = $request->header('Authorization')[0];
            $date = Carbon::createFromFormat(Carbon::RFC7231_FORMAT, $request->header('Date')[0], 'UTC');

            $expectedSignature = TalentaApi::createAuthenticationSignature($date, $request->toPsrRequest(), env('TALENTA_HMAC_SECRET'));
            $actualSignature = Str::between($authorization, 'signature="', '"');

            return hash_equals($expectedSignature, $actualSignature);
        });

        Response::macro('assertSameWithJsonPath', function (string $expectedJsonPath) {
            /** @var \Illuminate\Http\Client\Response $actualResponse */
            $actualResponse = $this;

            Assert::assertJsonStringEqualsJsonString(
                ApiTestCase::getJsonFromResponsesPath($expectedJsonPath),
                $actualResponse->body()
            );
        });
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /**
     * Return JSON request from the given path.
     *
     * @param  string  $jsonPath
     * @return string|false
     */
    public static function getJsonFromRequestsPath(string $jsonPath)
    {
        return file_get_contents(__DIR__.'/requests/'.$jsonPath);
    }

    /**
     * Return JSON response from the given path.
     *
     * @param  string  $jsonPath
     * @return string|false
     */
    public static function getJsonFromResponsesPath(string $jsonPath)
    {
        return file_get_contents(__DIR__.'/responses/'.$jsonPath);
    }
}
