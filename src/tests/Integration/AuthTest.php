<?php

declare(strict_types=1);

namespace Tests\Integration;

use Tests\BaseTestCase;

class AuthTest extends BaseTestCase
{
    public function test_should_login_successfully(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'naruto.uzumaki@ems.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_should_logout_successfully(): void
    {
        $response = $this->postJson(
            uri: '/api/auth/login',
            data: [
                'email' => 'naruto.uzumaki@ems.com',
                'password' => 'password',
            ]
        );
        $token = $response->json();

        $response = $this->postJsonAuthorised(
            uri: '/api/auth/logout',
            token: $token
        );

        $response->assertStatus(200);
    }

    public function test_should_fail_login(): void
    {
        $response = $this->postJson(
            uri: '/api/auth/login',
            data: [
                'email' => 'naruto.uzumaki@ems.com',
                'password' => 'wrongPassword',
            ]
        );

        $response->assertStatus(401);
    }
}
