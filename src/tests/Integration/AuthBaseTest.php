<?php

declare(strict_types=1);

namespace Tests\Integration;

use Tests\BaseTestCase;

class AuthBaseTest extends BaseTestCase
{

    public function testShouldLoginSuccessfully(): void
    {
        $response = $this->postJson("/api/auth/login", [
            "email" => "admin@ems.com",
            "password" => "password"
        ]);

        $response->assertStatus(200);
    }

    public function testShouldLogoutSuccessfully(): void
    {
        $response = $this->postJson(
            uri: "/api/auth/login",
            data: [
                "email" => "admin@ems.com",
                "password" => "password"
            ]
        );
        $token = $response->json();

        $response = $this->postJsonAuthorised(
            uri: "/api/auth/logout",
            token: $token
        );

        $response->assertStatus(200);
    }

    public function testShouldFailLogin(): void
    {
        $response = $this->postJson(
            uri: "/api/auth/login",
            data: [
                "email" => "admin@ems.com",
                "password" => "wrongPassword"
            ]
        );

        $response->assertStatus(401);
    }

}
