<?php

declare(strict_types=1);

namespace Tests\Integration;

use Tests\BaseTestCase;

class AuthBaseTest extends BaseTestCase
{

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function shouldLoginSucessfully(): void
    {
        $response = $this->postJson("/api/auth/login", [
            "email" => "admin@ems.com",
            "password" => "password"
        ]);

        dd($response);
    }
}
