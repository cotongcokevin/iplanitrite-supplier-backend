<?php

declare(strict_types=1);

namespace Tests\Integration;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Testing\TestResponse;
use Ramsey\Uuid\Uuid;
use Spatie\Snapshots\MatchesSnapshots;

abstract class BaseTestCase extends TestCase
{
    use MatchesSnapshots;

    abstract public function getBaseUri(): string;

    abstract public function getDefaultAuthEmail(): string;

    abstract public function getDefaultAuthPassword(): string;

    public function generateUri(string $uri): string
    {
        $baseUri = $this->getBaseUri();

        return $baseUri.$uri;
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
        ?string $email = null,
        ?string $password = null
    ): TestResponse {
        $uri = self::generateUri('/auth/login');

        return $this->postJson(
            uri: $uri,
            data: [
                'email' => $email ?? $this->getDefaultAuthEmail(),
                'password' => $password ?? $this->getDefaultAuthPassword(),
            ]
        );
    }

    public function cleanAutoBeforeAssertingJsonSnapshot(
        array $resultArray
    ): void {
        $recursiveReplace = function (&$data) use (&$recursiveReplace) {
            foreach ($data as $key => &$value) {
                if (is_array($value) || is_object($value)) {
                    $recursiveReplace($value);
                } else {
                    if (in_array($key, ['createdAt', 'updatedAt']) && $value !== null) {
                        Carbon::parse($value);
                        $value = '__FORMAT_VALIDATED__';
                    }

                    if (in_array($key, ['id', 'createdBy', 'updatedBy']) && $value !== null) {
                        Uuid::fromString($value);
                        $value = '__FORMAT_VALIDATED__';
                    }

                    if ($key === 'password') {
                        $value = '__FORMAT_VALIDATED__';
                    }
                }
            }
        };
        $recursiveReplace($resultArray);

        $this->assertMatchesJsonSnapshot($resultArray);
    }
}
