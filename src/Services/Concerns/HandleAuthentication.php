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
            $date = Carbon::now()->toRfc7231String();
            $requestLine = sprintf('%s %s HTTP/1.1', $request->method(), $request->url());

            $digest = hash_hmac('sha256', implode('\n', [
                'date: ' . $date,
                $requestLine,
            ]), $this->config['hmac_secret']);

            $signature = base64_encode($digest);

            $hmacHeader = [
                'hmac username' => $this->config['hmac_username'],
                'algorithm' => 'hmac-sha256',
                'headers' => 'date request-line',
                'signature' => $signature,
            ];

            $authorization = collect($hmacHeader)
                ->map(fn ($value, $key) => sprintf('%s="%s"', $key, $value))
                ->implode(', ');

            $pendingRequest->withHeaders([
                'Authorization' => $authorization,
                'Date' => $date,
            ]);
        };
    }

    /**
     * Create a callback to handle request retrying process when the given response is unauthorized.
     *
     * @return \Closure
     */
    protected function retryRequestWhenUnauthorized(): Closure
    {
        return fn (Throwable $exception) =>
            $exception instanceof RequestException &&
            $exception->getCode() === HttpResponse::HTTP_UNAUTHORIZED;
    }
}
