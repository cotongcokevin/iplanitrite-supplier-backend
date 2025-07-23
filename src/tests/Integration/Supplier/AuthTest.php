<?php

declare(strict_types=1);

namespace Tests\Integration\Supplier;

use Tests\Integration\SupplierTestCase;

class AuthTest extends SupplierTestCase
{
    public function test_supplier_should_login_successfully(): void
    {
        $uri = self::generateUri('/auth/login');

        $response = $this->postJson($uri, [
            'email' => 'luffy.monkey@ems.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_supplier_should_logout_successfully(): void
    {
        $uri = self::generateUri('/auth/login');
        $response = $this->postJson(
            uri: $uri,
            data: [
                'email' => 'luffy.monkey@ems.com',
                'password' => 'password',
            ]
        );
        $response->assertStatus(200);
        $token = $response->json();

        $uriLogout = self::generateUri('/auth/logout');
        $response = $this->postJsonAuthorised(
            uri: $uriLogout,
            token: $token
        );

        $response->assertStatus(200);
    }

    public function test_supplier_should_fail_login(): void
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

    public function test_supplier_token_should_not_work_on_other_admin(): void
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

    public function test_supplier_token_should_not_work_on_other_client(): void
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
