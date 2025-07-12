<?php

declare(strict_types=1);

namespace Admin;

use Tests\Integration\AdminTestCase;

class AdminAuthTest extends AdminTestCase
{
    public function test_should_login_successfully(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson($uri, [
            'email' => 'naruto.uzumaki@ems.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_should_logout_successfully(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson(
            uri: $uri,
            data: [
                'email' => 'naruto.uzumaki@ems.com',
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

    public function test_should_fail_login(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson(
            uri: $uri,
            data: [
                'email' => 'naruto.uzumaki@ems.com',
                'password' => 'wrongPassword',
            ]
        );

        $response->assertStatus(401);
    }
}
