<?php

namespace Ianriizky\TalentaApi\Services\Concerns;

use Closure;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Carbon;
use Throwable;

/**
 * @property \Illuminate\Http\Client\PendingRequest $request
 * @property array $config
 */
trait HandleAuthentication
{
    /**
     * Create a callback to set authentication data before sending the request.
     *
     * @return \Closure
     */
    protected function authenticateRequest(): Closure
    {
        return function (Request $request, array $options, PendingRequest $pendingRequest) {
            $pendingRequest->withHeaders(
                static::createAuthenticateRequestHeader(
                    $request,
                    $this->config['hmac_username'],
                    $this->config['hmac_secret']
                )
            );
        };
    }

    /**
     * Create authentication request header.
     *
     * @param  \Illuminate\Http\Client\Request  $request
     * @param  string  $hmacUsername
     * @param  string  $hmacSecret
     * @return array<string, string>
     */
    protected static function createAuthenticateRequestHeader(Request $request, string $hmacUsername, string $hmacSecret): array
    {
        $date = Carbon::now()->toRfc7231String();

        $requestLine = sprintf(
            '%s %s HTTP/%s',
            $request->method(),
            $request->toPsrRequest()->getUri()->withScheme('')->withHost(''),
            $request->toPsrRequest()->getProtocolVersion()
        );

        $digest = hash_hmac('sha256', implode("\n", [
            'date: '.$date,
            $requestLine,
        ]), $hmacSecret, true);

        $signature = base64_encode($digest);

        $hmacHeader = [
            'hmac username' => $hmacUsername,
            'algorithm' => 'hmac-sha256',
            'headers' => 'date request-line',
            'signature' => $signature,
        ];

        $authorization = collect($hmacHeader)->map(function ($value, $key) {
            return sprintf('%s="%s"', $key, $value);
        })->implode(', ');

        return [
            'Authorization' => $authorization,
            'Date' => $date,
        ];
    }

    /**
     * Create a callback to handle request retrying process when the given response is unauthorized.
     *
     * @return \Closure
     */
    protected function retryRequestWhenUnauthorized(): Closure
    {
        return function (Throwable $exception) {
            return
                $exception instanceof RequestException &&
                $exception->getCode() === HttpResponse::HTTP_UNAUTHORIZED;
        };
    }
}
