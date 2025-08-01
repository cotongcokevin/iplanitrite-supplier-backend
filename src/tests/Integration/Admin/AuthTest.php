<?php

declare(strict_types=1);

namespace Tests\Integration\Admin;

use Tests\Integration\AdminTestCase;

class AuthTest extends AdminTestCase
{
    public function test_admin_login(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson($uri, [
            'email' => 'cotongcokevin@iplanitrite.com',
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
                'email' => 'cotongcokevin@iplanitrite.com',
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
                'email' => 'cotongcokevin@iplanitrite.com',
                'password' => 'wrongPassword',
            ]
        );

        $response->assertStatus(401);
    }

    public function test_admin_token_should_not_work_on_supplier(): void
    {
        $token = $this->login();
        $uri = '/api/supplier/profile';
        $response = $this->postJsonAuthorised(
            uri: $uri,
            token: $token->json(),
            checkOk: false
        );

        $response->assertStatus(401);
    }

    public function test_admin_token_should_not_work_on_client(): void
    {
        $token = $this->login();
        $uri = '/api/client/profile';
        $response = $this->postJsonAuthorised(
            uri: $uri,
            token: $token->json(),
            checkOk: false
        );

        $response->assertStatus(401);
    }
}
