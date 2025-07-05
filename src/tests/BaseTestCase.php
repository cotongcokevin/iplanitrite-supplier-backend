<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Testing\TestResponse;

abstract class BaseTestCase extends TestCase
{

    /**
     * @param string $uri
     * @param string $token
     * @param array $data
     * @return TestResponse
     */
    public function postJsonAuthorised(
        string $uri,
        string $token,
        array $data = []
    ): TestResponse {
        return $this->postJson(
            uri: $uri,
            data: $data,
            headers: [
                'Authorization' => 'Bearer '.$token,
            ]
        );
    }

}
