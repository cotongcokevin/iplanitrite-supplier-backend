<?php

declare(strict_types=1);

namespace Tests\Integration;

use Illuminate\Foundation\Http\Kernel;
use Symfony\Component\HttpFoundation\Response;
use Tests\BaseTestCase;

class AuthBaseTest extends BaseTestCase
{

    /** @test */
    public function shouldLoginSuccessfully(): void
    {
        $response = $this->postJson("/api/auth/login", [
            "email" => "admin@ems.com",
            "password" => "password"
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function shouldFailLogin(): void
    {
        $response = $this->postJson("/api/auth/login", [
            "email" => "admin@ems.com",
            "password" => "wrongPassword"
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
