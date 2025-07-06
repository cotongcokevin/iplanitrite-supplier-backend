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
    public function getJsonAuthorised(
        string $uri,
        string $token,
        array $data = []
    ): TestResponse {
        $params = !empty($data) ? "?".http_build_query($data) : "";

        return $this->getJson(
            uri: $uri.$params,
            headers: [
                'Authorization' => 'Bearer '.$token,
            ]
        );
    }

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

    /**
     * @param string $uri
     * @param string $token
     * @param array $data
     * @return TestResponse
     */
    public function putJsonAuthorised(
        string $uri,
        string $token,
        array $data = []
    ): TestResponse {
        return $this->putJson(
            uri: $uri,
            data: $data,
            headers: [
                'Authorization' => 'Bearer '.$token,
            ]
        );
    }

    /**
     * @param string $uri
     * @param string $token
     * @param array $data
     * @return TestResponse
     */
    public function deleteJsonAuthorised(
        string $uri,
        string $token,
        array $data = []
    ): TestResponse {
        return $this->deleteJson(
            uri: $uri,
            data: $data,
            headers: [
                'Authorization' => 'Bearer '.$token,
            ]
        );
    }

    /**
     * @return string
     */
    public function getToken(): string {
        $response = $this->postJson(
            uri: "/api/auth/login",
            data: [
                "email" => "naruto.uzumaki@ems.com",
                "password" => "password"
            ]
        );

        return $response->json();
    }

}
