<?php

declare(strict_types=1);

use Tests\Integration\BaseTestCase;

class SupplierTemplateChecklistTest extends BaseTestCase
{
    private function getData(string $token)
    {
        return $this->getJsonAuthorised(
            uri: self::generateUri('/templates/checklist-groups/general/supplier'),
            token: $token,
        )->json();
    }

    public function test_supplier_template_checklist_group_insert()
    {
        $token = $this->login();
        $data = $this->getData($token->json());

        $response = $this->postJsonAuthorised(
            uri: self::generateUri('/templates/checklist-groups'),
            token: $token->json(),
            data: [
                'section' => 'GENERAL',
                'accountableTo' => 'SUPPLIER',
                'name' => 'AAA',
            ]
        );
        $response->assertStatus(200);

        $response = $this->getJsonAuthorised(
            uri: self::generateUri('/templates/checklist-groups/general/supplier'),
            token: $token->json(),
        );
        $resultArray = $response->json();
        $this->assertCount(count($data) + 1, $resultArray);
        $this->cleanAutoBeforeAssertingJsonSnapshot($resultArray);
    }

    public function test_supplier_template_checklist_group_update()
    {
        $token = $this->login();
        $data = $this->getData($token->json());
        $lastCount = count($data);
        $id = $data[0]['id'];

        $response = $this->putJsonAuthorised(
            uri: self::generateUri("/templates/checklist-groups/$id"),
            token: $token->json(),
            data: [
                'name' => 'NEW ONE',
                'sortOrder' => 5,
            ]
        );
        $response->assertStatus(200);

        $data = $this->getData($token->json());
        $this->assertCount($lastCount, $data);
        $this->cleanAutoBeforeAssertingJsonSnapshot($data);
    }

    public function test_admin_delete()
    {
        $token = $this->login();
        $data = $this->getData($token->json());
        $lastCount = count($data);
        $id = $data[0]['id'];

        $response = $this->deleteJsonAuthorised(
            uri: self::generateUri("/templates/checklist-groups/$id"),
            token: $token->json(),
        );
        $response->assertStatus(200);

        $data = $this->getData($token->json());
        $this->assertCount($lastCount - 1, $data);
        $this->cleanAutoBeforeAssertingJsonSnapshot($data);
    }
}
