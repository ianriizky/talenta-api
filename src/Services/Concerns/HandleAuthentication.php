<?php

namespace Ianriizky\TalentaApi\Services\Concerns;

use Closure;
use Ianriizky\TalentaApi\Http\Client\PendingRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Carbon;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Throwable;

/**
 * @property \Ianriizky\TalentaApi\Http\Client\PendingRequest $request
 * @property array $config
 */
trait HandleAuthentication
{
    /**
     * Create a callback to set authentication data before sending the request.
     *
     * @return callable
     */
    protected function authenticateRequest(): callable
    {
        return function (Request $request, array $options, PendingRequest $pendingRequest): RequestInterface {
            $headers = static::createAuthenticationRequestHeader(
                $request->toPsrRequest(),
                $this->config['hmac_username'],
                $this->config['hmac_secret']
            );

            return $request->toPsrRequest()
                ->withHeader('Authorization', $headers['Authorization'])
                ->withHeader('Date', $headers['Date']);
        };
    }

    /**
     * Create authentication request header.
     *
     * @param  \Psr\Http\Message\RequestInterface  $request
     * @param  string  $hmacUsername
     * @param  string  $hmacSecret
     * @param  \Illuminate\Support\Carbon|null  $date
     * @return array<string, string>
     */
    protected static function createAuthenticationRequestHeader(RequestInterface $request, string $hmacUsername, string $hmacSecret, Carbon $date = null): array
    {
        $date = $date ?? Carbon::now();

        $hmacHeader = [
            'hmac username' => $hmacUsername,
            'algorithm' => 'hmac-sha256',
            'headers' => 'date request-line',
            'signature' => static::createAuthenticationSignature($date, $request, $hmacSecret),
        ];

        $authorization = collect($hmacHeader)->map(function ($value, $key) {
            return sprintf('%s="%s"', $key, $value);
        })->implode(', ');

        return [
            'Authorization' => $authorization,
            'Date' => $date->toRfc7231String(),
        ];
    }

    /**
     * Create authentication signature using sha256 hash and base64 encoding.
     *
     * @param  \Illuminate\Support\Carbon  $date
     * @param  string|\Psr\Http\Message\RequestInterface  $request
     * @param  string  $hmacSecret
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected static function createAuthenticationSignature(Carbon $date, $request, string $hmacSecret): string
    {
        if (is_string($request)) {
            $requestLine = $request;
        } elseif ($request instanceof RequestInterface) {
            $requestLine = sprintf(
                '%s %s HTTP/%s',
                $request->getMethod(),
                $request->getUri()->withScheme('')->withHost(''),
                $request->getProtocolVersion()
            );
        } else {
            throw new InvalidArgumentException('The given $request parameter must be a string or a '.RequestInterface::class.' instance.');
        }

        $digest = hash_hmac('sha256', implode("\n", [
            'date: '.$date->toRfc7231String(),
            $requestLine,
        ]), $hmacSecret, true);

        return base64_encode($digest);
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
