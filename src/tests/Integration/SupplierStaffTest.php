<?php

declare(strict_types=1);

namespace Tests\Integration;

class SupplierStaffTest extends BaseTestCase
{
    public function test_supplier_staff_search_all()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: $this->generateUri('/staff'),
            token: $token->json(),
        );

        $response->assertStatus(200);

        $resultArray = $response->json();
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }

    public function test_supplier_staff_get_by_id_with_context()
    {
        $token = $this->login();
        $response = $this->getJsonAuthorised(
            uri: $this->generateUri('/staff/781479fe-1d65-418a-bc4f-8317452d8452'),
            token: $token->json(),
        );

        $response->assertStatus(200);

        $resultArray = $response->json();
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }
}
