<?php

declare(strict_types=1);

namespace Admin;

use Database\Seeders\AdminSeeder;
use Tests\Integration\AdminTestCase;

class AdminTest extends AdminTestCase
{
    public function test_should_search_all_data()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/admin'),
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
            uri: self::generateUri('/admin/'.AdminSeeder::$ADMIN_TWO_ID),
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
            uri: self::generateUri('/admin'),
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
            uri: self::generateUri('/admin/'.AdminSeeder::$ADMIN_TWO_ID),
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
            uri: self::generateUri('/admin'),
            token: $token->json(),
        );
        $toDelete = collect($response->json())->where('email', 'john@doe.com')->first();

        $id = $toDelete['id'];
        $response = $this->deleteJsonAuthorised(
            uri: self::generateUri('/admin/'.$id),
            token: $token->json()
        );
        $response->assertStatus(200);

        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/admin'),
            token: $token->json(),
        );
        $this->assertCount(2, $response->json());
    }
}
