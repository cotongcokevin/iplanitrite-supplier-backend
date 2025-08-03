<?php

declare(strict_types=1);

namespace Tests\Integration\Admin;

use App\Enums\SubscriptionTier;
use Database\Seeders\Classes\SupplierSeeder;
use Tests\Integration\AdminTestCase;

class SupplierTest extends AdminTestCase
{
    public function test_suppliers_search_all()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/suppliers'),
            token: $token->json(),
        );

        $response->assertStatus(200);

        $resultArray = $response->json();
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }

    public function test_suppliers_find_by_id()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/suppliers/'.SupplierSeeder::SUPPLIER_ONE_ID),
            token: $token->json(),
        );

        $response->assertStatus(200);
        $resultArray = $response->json();
        $this->assertEquals('One Piece', $resultArray['name']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }

    public function test_suppliers_insert()
    {
        $token = $this->login();
        $response = $this->postJsonAuthorised(
            uri: self::generateUri('/suppliers'),
            token: $token->json(),
            data: [
                'name' => 'Supplier Test 1',
                'description' => 'Supplier Test 1 Description',
                'subscriptionTier' => SubscriptionTier::STANDARD,
            ]
        );

        $response->assertStatus(200);

        $resultArray = $response->json();
        $this->assertEquals('Supplier Test 1', $resultArray['name']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }

    public function test_suppliers_update()
    {
        $token = $this->login();
        $response = $this->putJsonAuthorised(
            uri: self::generateUri('/suppliers/'.SupplierSeeder::SUPPLIER_ONE_ID),
            token: $token->json(),
            data: [
                'name' => 'Two Piece',
                'description' => 'Sample Update Description',
                'subscriptionTier' => SubscriptionTier::PREMIUM,
            ]
        );

        $response->assertStatus(200);

        $resultArray = $response->json();
        $this->assertEquals('Two Piece', $resultArray['name']);
        $this->assertEquals('Sample Update Description', $resultArray['description']);
        $this->assertEquals(SubscriptionTier::PREMIUM->value, $resultArray['subscriptionTier']);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }

    public function test_suppliers_delete()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/suppliers'),
            token: $token->json(),
        );
        $toDelete = collect($response->json())->where('name', 'Supplier Test 1')->first();

        $id = $toDelete['id'];
        $response = $this->deleteJsonAuthorised(
            uri: self::generateUri('/suppliers/'.$id),
            token: $token->json()
        );
        $response->assertStatus(200);

        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/suppliers'),
            token: $token->json(),
        );
        $this->assertCount(2, $response->json());
    }
}
