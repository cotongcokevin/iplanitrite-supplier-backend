<?php

declare(strict_types=1);

namespace Tests\Integration\Client;

use Tests\Integration\ClientTestCase;

class AuthTest extends ClientTestCase
{
    public function test_client_login(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson($uri, [
            'email' => 'asta.staria@client.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_client_logout(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson(
            uri: $uri,
            data: [
                'email' => 'asta.staria@client.com',
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
                'email' => 'asta.staria@client.com',
                'password' => 'wrongPassword',
            ]
        );

        $response->assertStatus(401);
    }

    public function test_client_token_should_not_work_on_supplier(): void
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

    public function test_client_token_should_not_work_on_admin(): void
    {
        $token = $this->login();
        $uri = '/api/admin/profile';
        $response = $this->postJsonAuthorised(
            uri: $uri,
            token: $token->json(),
            checkOk: false
        );

        $response->assertStatus(401);
    }
}
