<?php

declare(strict_types=1);

namespace Tests\Integration\Admin;

use Database\Seeders\Classes\AdminSeeder;
use Tests\Integration\AdminTestCase;

class AdminTest extends AdminTestCase
{
    public function test_admin_search_all()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/admin'),
            token: $token->json(),
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }

    public function test_admin_find_by_id()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/admin/'.AdminSeeder::ADMIN_TWO_ID),
            token: $token->json(),
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->assertEquals('andrew@iplanitrite.com', $resultArray['email']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }

    public function test_admin_insert()
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
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }

    public function test_admin_update()
    {
        $token = $this->login();
        $response = $this->putJsonAuthorised(
            uri: self::generateUri('/admin/'.AdminSeeder::ADMIN_TWO_ID),
            token: $token->json(),
            data: [
                'email' => 'abcd@iplanitrite.com',
                'password' => 'password',
                'firstName' => 'AB',
                'lastName' => 'CD',
            ]
        );
        $response->assertStatus(200);

        $resultArray = $response->json();
        $this->assertEquals('abcd@iplanitrite.com', $resultArray['email']);
        $this->assertEquals('AB', $resultArray['firstName']);
        $this->assertEquals('CD', $resultArray['lastName']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);

        $response = $this->putJsonAuthorised(
            uri: self::generateUri('/admin/'.AdminSeeder::ADMIN_TWO_ID),
            token: $token->json(),
            data: [
                'email' => 'andrew@iplanitrite.com',
                'password' => 'password',
                'firstName' => 'Andrew',
                'lastName' => 'Llorera',
            ]
        );
        $response->assertStatus(200);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }

    public function test_admin_delete()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/admin'),
            token: $token->json(),
        );
        $total = collect($response->json())->count();
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
        $this->assertCount($total - 1, $response->json());
    }
}
