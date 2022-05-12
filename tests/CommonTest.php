<?php

namespace Ianriizky\TalentaApi\Tests;

use Ianriizky\TalentaApi\Support\Facades\TalentaApi;
use Illuminate\Http\Client\PendingRequest;

class CommonTest extends TestCase
{
    public function test_that_talenta_api_request_method_has_correct_return_value()
    {
        $this->assertInstanceOf(PendingRequest::class, TalentaApi::request());
    }
}
