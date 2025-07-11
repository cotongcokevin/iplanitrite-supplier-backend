<?php

declare(strict_types=1);

namespace Admin;

use Tests\Integration\AdminTestCase;

class ProfileTest extends AdminTestCase
{
    public function test_should_update_logged_in_user_profile(): void
    {
        // Create a new one
        $token = $this->login();
        $this->postJsonAuthorised(
            uri: self::generateUri('/admin'),
            token: $token->json(),
            data: [
                'email' => 'abc.def@ems.com',
                'password' => 'password',
                'firstName' => 'Abc',
                'lastName' => 'Def',
            ]
        );

        // Login and Update the profile
        $token = $this->login('abc.def@ems.com');
        $response = $this->postJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json(),
            data: [
                'email' => 'hinata.hyuga@ems.com',
                'password' => 'password2',
                'firstName' => 'Hinata',
                'lastName' => 'Hyuga',
            ]
        );
        $response->assertStatus(200);
        $this->cleanAutoBeforeAssertingJsonSnapshot($response->json());

        $this->getJsonAuthorised(
            uri: '/api/admin',
            token: $token->json()
        );
    }

    public function test_should_fetch_logged_in_user_profile(): void
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json()
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->assertEquals('naruto.uzumaki@ems.com', $resultArray['email']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }
}
