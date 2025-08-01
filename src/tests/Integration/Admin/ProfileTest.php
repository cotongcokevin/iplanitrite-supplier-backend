<?php

declare(strict_types=1);

namespace Tests\Integration\Admin;

use Tests\Integration\AdminTestCase;

class ProfileTest extends AdminTestCase
{
    public function test_admin_update_profile(): void
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
        $this->cleanAutoBeforeAssertingJsonSnapshot($response->json());
    }

    public function test_admin_get_profile(): void
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json()
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->assertEquals('cotongcokevin@iplanitrite.com', $resultArray['email']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }
}
