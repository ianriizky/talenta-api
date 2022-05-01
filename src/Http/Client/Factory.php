<?php

namespace Ianriizky\TalentaApi\Http\Client;

use Illuminate\Http\Client\Factory as LaravelFactory;

class Factory extends LaravelFactory
{
    /**
     * {@inheritDoc}
     *
     * @return \Ianriizky\TalentaApi\Http\Client\PendingRequest
     */
    protected function newPendingRequest()
    {
        return new PendingRequest($this);
    }
}
