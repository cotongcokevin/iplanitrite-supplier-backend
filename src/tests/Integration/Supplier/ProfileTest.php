<?php

declare(strict_types=1);

namespace Tests\Integration\Supplier;

use Tests\Integration\SupplierTestCase;

class ProfileTest extends SupplierTestCase
{
    public function test_supplier_update_profile(): void
    {
        // Create a new one
        $token = $this->login();
        $this->postJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json(),
            data: [
                'password' => 'password',
                'firstName' => 'Luffy',
                'lastName' => 'Monkey',
                'dateOfBirth' => '2020-01-01',
                'contactNumber' => '9954585215',
                'address' => [
                    'line1' => 'Line 1',
                    'line2' => null,
                    'city' => 'SampleCity',
                    'state' => 'SampleState',
                    'zip' => 'SampleZip',
                    'lat' => null,
                    'long' => null,
                ],
            ]
        );

        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json()
        );

        $response->assertStatus(200);
        $result = $response->json();
        $this->assertNotNull($result['second']['address']);
        $this->assertNotNull($result['second']['contactNumber']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($response->json());

        $this->getJsonAuthorised(
            uri: '/api/admin',
            token: $token->json()
        );
    }

    public function test_supplier_get_profile(): void
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json()
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->assertEquals('luffy.monkey@ems.com', $resultArray['first']['email']);
        $this->assertNotNull($resultArray['second']['address']);
        $this->assertNotNull($resultArray['second']['contactNumber']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }
}
