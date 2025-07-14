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
        foreach (['createdAt', 'updatedAt'] as $dateCheck) {
            if (! empty($resultArray[$dateCheck])) {
                Carbon::parse($resultArray[$dateCheck]);
                $resultArray[$dateCheck] = '__FORMAT_VALIDATED__';
            }
        }

        foreach (['id', 'createdBy', 'updatedBy'] as $idCheck) {
            if (! empty($resultArray[$idCheck])) {
                Uuid::fromString($resultArray[$idCheck]);
                $resultArray[$idCheck] = '__FORMAT_VALIDATED__';
            }
        }

        if (! empty($resultArray['password'])) {
            $resultArray['password'] = '__FORMAT_VALIDATED__';
        }

        $this->assertMatchesJsonSnapshot($resultArray);
    }
}
