<?php

declare(strict_types=1);

use Tests\BaseTestCase;

class AdminTest extends BaseTestCase
{
    public function test_should_search_all_data()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: '/api/admin',
            token: $token->json(),
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->assertCount(2, $resultArray);
    }

    public function test_should_find_by_id()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: '/api/admin/8dd17f21-524d-4ad9-8604-b7afe060fe3d',
            token: $token->json(),
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->assertEquals('sasuke.uchiha@ems.com', $resultArray['email']);
    }

    public function test_should_insert_data()
    {
        $token = $this->login();
        $response = $this->postJsonAuthorised(
            uri: '/api/admin',
            token: $token->json(),
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
        $token = $this->login();
        $response = $this->putJsonAuthorised(
            uri: '/api/admin/8dd17f21-524d-4ad9-8604-b7afe060fe3d',
            token: $token->json(),
            data: [
                'email' => 'itachi.uchiha@ems.com',
                'password' => 'password',
                'firstName' => 'Itachi',
                'lastName' => 'Uchiha',
            ]
        );

        $response->assertStatus(200);

        $resultArray = $response->json();
        $this->assertEquals('itachi.uchiha@ems.com', $resultArray['email']);
        $this->assertEquals('Itachi', $resultArray['firstName']);
        $this->assertEquals('Uchiha', $resultArray['lastName']);
    }

    public function test_should_delete_data()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: '/api/admin',
            token: $token->json(),
        );
        $toDelete = collect($response->json())->where('email', 'john@doe.com')->first();

        $id = $toDelete['id'];
        $response = $this->deleteJsonAuthorised(
            uri: "/api/admin/$id",
            token: $token->json()
        );
        $response->assertStatus(200);

        $response = $this->getJsonAuthorised(
            uri: '/api/admin',
            token: $token->json(),
        );
        $this->assertCount(2, $response->json());
    }
}
