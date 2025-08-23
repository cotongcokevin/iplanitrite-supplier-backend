<?php

declare(strict_types=1);

namespace Tests\Integration;

class AuthTest extends BaseTestCase
{
    public function test_admin_login(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson($uri, [
            'email' => 'luffy.monkey@onepiece.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_admin_logout(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson(
            uri: $uri,
            data: [
                'email' => 'luffy.monkey@onepiece.com',
                'password' => 'password',
            ]
        );
        $token = $response->json();

        $uriLogout = self::generateUri('/auth/logout');
        $response = $this->postJsonAuthorised(
            uri: $uriLogout,
            token: $token
        );

        $response->assertStatus(200);
    }

    public function test_admin_invalid_credentials(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson(
            uri: $uri,
            data: [
                'email' => 'luffy.monkey@onepiece.com',
                'password' => 'wrongPassword',
            ]
        );

        $response->assertStatus(401);
    }
}
