<?php

declare(strict_types=1);

namespace Tests\Integration\Client;

use Tests\Integration\ClientTestCase;

class ProfileTest extends ClientTestCase
{
    public function test_client_update_profile(): void
    {
        $token = $this->login();
        $this->postJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json(),
            data: [
                'password' => 'password',
                'firstName' => 'Asta',
                'lastName' => 'Staria',
                'dateOfBirth' => '2020-01-01',
                'contactNumber' => '9954585215',
            ]
        );

        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json()
        );

        $response->assertStatus(200);
        $result = $response->json();
        $this->assertNotNull($result['context']['contactNumber']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($response->json());
    }

    public function test_client_get_profile(): void
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json()
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->assertEquals('asta.staria@client.com', $resultArray['email']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }
}
