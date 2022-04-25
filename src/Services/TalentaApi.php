<?php

namespace Ianriizky\TalentaApi\Services;

use BadMethodCallException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Macroable;
use RuntimeException;

/**
 * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1
 */
class TalentaApi
{
    use Macroable {
        __call as macroCall;
    }
    use Api\Employee;
    use Concerns\HandleAuthentication;
    use Concerns\HandlePendingRequest;

    /**
     * List of escaped method when __call() is called.
     *
     * @var array<int, string>
     */
    public static $escapedMethods = [
        'createRequestInstance',
        'sendRequestToTalenta',

        // Concerns\HandleAuthentication
        'authenticateRequest',
        'retryRequestWhenUnauthorized',
    ];

    /**
     * Instance of \Illuminate\Http\Client\PendingRequest to build the request.
     *
     * @var \Illuminate\Http\Client\PendingRequest
     */
    protected PendingRequest $request;

    /**
     * Create a new instance class.
     *
     * @param  array  $config
     * @param  string|bool|null  $sslVerify
     * @return void
     */
    public function __construct(protected array $config, $sslVerify = null)
    {
        $this->request = $this->createRequestInstance(
            $this->config['base_url'],
            $sslVerify,
            Arr::except($config['guzzle_options'], 'verify')
        );

        $this->request->beforeSending($this->authenticateRequest());

        $this->request->retry(
            $config['request_retry_times'],
            $config['request_retry_sleep'],
            $this->retryRequestWhenUnauthorized(),
            true
        );
    }

    /**
     * Send a request to the Talenta api based on the given method and parameters.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    protected function sendRequestToTalenta(string $method, array $parameters = []): Response
    {
        $response = $this->{$method}(...$parameters);

        if (! $response instanceof Response) {
            throw new RuntimeException(sprintf(
                'The return value from method %s::%s must be an instance of %s class.',
                static::class, $method, Response::class
            ));
        }

        // Use throw() method to make sure that it's always throw an exception
        // when the given response is error.
        return $response->throw();
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        if (in_array($method, static::$escapedMethods, true)) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s is in the escaped method list.', static::class, $method
            ));
        }

        return $this->sendRequestToTalenta($method, $parameters);
    }
}