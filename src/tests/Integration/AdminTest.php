<?php

declare(strict_types=1);

use Tests\BaseTestCase;

class AdminTest extends BaseTestCase
{
    public function test_should_search_all_data()
    {

        $token = $this->getToken();
        $response = $this->getJsonAuthorised(
            uri: '/api/admin',
            token: $token,
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->assertCount(2, $resultArray);
    }

    public function test_should_find_by_id()
    {

        $token = $this->getToken();
        $response = $this->getJsonAuthorised(
            uri: '/api/admin/8dd17f21-524d-4ad9-8604-b7afe060fe3d',
            token: $token,
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->assertEquals('sasuke.uchiha@ems.com', $resultArray['email']);
    }

    public function test_should_insert_data()
    {
        $token = $this->getToken();
        $response = $this->postJsonAuthorised(
            uri: '/api/admin',
            token: $token,
            data: [
                'email' => 'john@doe.com',
                'password' => 'password',
                'firstName' => 'John',
                'lastName' => 'Doe',
            ]
        );

        $response->assertStatus(200);

        $resultArray = $response->json();
        $this->assertEquals('john@doe.com', $resultArray['email']);
    }

    public function test_should_update_data()
    {
        $token = $this->getToken();
        $response = $this->putJsonAuthorised(
            uri: '/api/admin/8dd17f21-524d-4ad9-8604-b7afe060fe3d',
            token: $token,
            data: [
                'email' => 'abc@mouse.com',
                'password' => 'password',
                'firstName' => 'Abc',
                'lastName' => 'Mouse',
            ]
        );

        $response->assertStatus(200);

        $resultArray = $response->json();
        $this->assertEquals('abc@mouse.com', $resultArray['email']);
        $this->assertEquals('Abc', $resultArray['firstName']);
        $this->assertEquals('Mouse', $resultArray['lastName']);
    }
}
