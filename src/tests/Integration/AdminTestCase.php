<?php

declare(strict_types=1);

namespace Tests\Integration;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Testing\TestResponse;

abstract class AdminTestCase extends TestCase
{
    public static string $baseUri = '/api/admin';

    public static function generateUri(string $uri): string
    {
        return self::$baseUri.$uri;
    }

    public function getJsonAuthorised(
        string $uri,
        string $token,
        array $data = []
    ): TestResponse {
        $params = ! empty($data) ? '?'.http_build_query($data) : '';

        return $this->getJson(
            uri: $uri.$params,
            headers: [
                'Authorization' => 'Bearer '.$token,
            ]
        );
    }

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

    public function login(
        string $email = 'naruto.uzumaki@ems.com',
        string $password = 'password'
    ): TestResponse {
        $uri = self::generateUri('/auth/login');

        return $this->postJson(
            uri: $uri,
            data: [
                'email' => $email,
                'password' => $password,
            ]
        );
    }
}
