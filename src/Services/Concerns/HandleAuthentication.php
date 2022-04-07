<?php

namespace Ianriizky\TalentaApi\Services\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Arr;
use Throwable;

/**
 * @property \Illuminate\Http\Client\PendingRequest $request
 * @property array $config
 */
trait HandleAuthentication
{
    /**
     * Determine whether the request instance is authenticated or not.
     *
     * @return bool
     */
    protected function isRequestAuthenticated(): bool
    {
        // !! WIP
        return true;
    }

    /**
     * Set authentication data of the request instance.
     *
     * @return void
     */
    protected function authenticateRequest()
    {
        // !! WIP
    }

    /**
     * Return list of credential value from the config.
     *
     * @return array
     */
    protected function getCredentials(): array
    {
        return Arr::only($this->config, [
            'hmac_username',
            'hmac_secret',
        ]);
    }

    /**
     * Register closure on the request instance to handle login re-attempt process
     * when the given response is unauthorized.
     *
     * @param  int  $times
     * @param  int  $sleep
     * @param  bool  $throw
     * @return void
     */
    protected function reattemptLoginWhenUnauthorized(int $times, int $sleep = 0, bool $throw = true)
    {
        $this->request->retry($times, $sleep, function (Throwable $exception, PendingRequest $request) {
            if (! $exception instanceof RequestException || $exception->getCode() !== HttpResponse::HTTP_UNAUTHORIZED) {
                return false;
            }

            // !! WIP

            return true;
        }, $throw);
    }
}
