<?php

namespace Ianriizky\TalentaApi\Services\Concerns;

use Ianriizky\TalentaApi\Http\Client\PendingRequest;
use Ianriizky\TalentaApi\Support\Facades\Http;

trait HandlePendingRequest
{
    use ParseUrl;

    /**
     * Base url of the PendingRequest instance.
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * List of option used on the PendingRequest::withOptions() instance.
     *
     * @var array
     */
    protected $options;

    /**
     * Create a Laravel HTTP client request instance.
     *
     * @param  string  $baseUrl
     * @param  string|bool|null  $sslVerify
     * @param  array  $options
     * @return \Ianriizky\TalentaApi\Http\Client\PendingRequest
     */
    protected function createRequestInstance(string $baseUrl, $sslVerify = null, array $options = []): PendingRequest
    {
        if (! is_null($sslVerify)) {
            $options = array_merge_recursive($options, [
                'verify' => $sslVerify,
            ]);
        }

        $this->baseUrl = static::parseBaseUrl($baseUrl);
        $this->options = $options;

        return $this->createFreshRequestInstance();
    }

    /**
     * Create a fresh Laravel HTTP client request instance using the previous $baseUrl and $options property.
     *
     * @return \Ianriizky\TalentaApi\Http\Client\PendingRequest
     */
    protected function createFreshRequestInstance(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)->withOptions($this->options);
    }
}
