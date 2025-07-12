<?php

declare(strict_types=1);

namespace Organizer;

use Tests\Integration\OrganizerTestCase;

class AuthTest extends OrganizerTestCase
{
    public function test_organizer_should_login_successfully(): void
    {
        $uri = self::generateUri('/auth/login');

        $response = $this->postJson($uri, [
            'email' => 'luffy.monkey@ems.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_organizer_should_logout_successfully(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson(
            uri: $uri,
            data: [
                'email' => 'luffy.monkey@ems.com',
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

    public function test_organizer_should_fail_login(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson(
            uri: $uri,
            data: [
                'email' => 'luffy.monkey@ems.com',
                'password' => 'wrongPassword',
            ]
        );

        $response->assertStatus(401);
    }
}
