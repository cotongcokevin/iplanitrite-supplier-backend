<?php

declare(strict_types=1);

namespace Tests\Integration\Supplier;

use Tests\Integration\SupplierTestCase;

class ProfileTest extends SupplierTestCase
{
    public function test_supplier_update_profile(): void
    {
        $token = $this->login();
        $updateResponse = $this->postJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json(),
            data: [
                'password' => 'password',
                'firstName' => 'Luffy',
                'lastName' => 'Monkey',
                'dateOfBirth' => '2020-01-01',
                'contactNumber' => '9954585211',
                'address' => [
                    'line1' => 'Line 1',
                    'line2' => null,
                    'city' => 'SampleCity',
                    'state' => 'SampleState',
                    'zip' => 'SampleZip',
                    'lat' => null,
                    'long' => null,
                ],
            ],
            checkOk: false
        );

        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json()
        );

        $result = $response->json();
        $this->assertNotNull($result['context']['address']);
        $this->assertNotNull($result['context']['contactNumber']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($response->json());
    }

    public function test_supplier_get_profile(): void
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/profile'),
            token: $token->json()
        );
        $resultArray = $response->json();

        $this->assertEquals('luffy.monkey@ems.com', $resultArray['email']);
        $this->assertNotNull($resultArray['context']['address']);
        $this->assertNotNull($resultArray['context']['contactNumber']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }
}
