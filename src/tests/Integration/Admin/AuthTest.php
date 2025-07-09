<?php

declare(strict_types=1);

namespace Admin;

use Tests\Integration\AdminTestCase;

class AuthTest extends AdminTestCase
{
    public function test_should_login_successfully(): void
    {
        $response = $this->postJson('/api/admin/auth/login', [
            'email' => 'naruto.uzumaki@ems.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_should_logout_successfully(): void
    {
        $response = $this->postJson(
            uri: '/api/admin/auth/login',
            data: [
                'email' => 'naruto.uzumaki@ems.com',
                'password' => 'password',
            ]
        );
        $token = $response->json();

        $response = $this->postJsonAuthorised(
            uri: '/api/admin/auth/logout',
            token: $token
        );

        $response->assertStatus(200);
    }

    public function test_should_fail_login(): void
    {
        $response = $this->postJson(
            uri: '/api/admin/auth/login',
            data: [
                'email' => 'naruto.uzumaki@ems.com',
                'password' => 'wrongPassword',
            ]
        );

        $response->assertStatus(401);
    }
}
