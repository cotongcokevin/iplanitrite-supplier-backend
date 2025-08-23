<?php

declare(strict_types=1);

use Tests\Integration\BaseTestCase;

class SupplierTemplateChecklistTest extends BaseTestCase
{
    private function getGroups(string $token)
    {
        return $this->getJsonAuthorised(
            uri: self::generateUri('/templates/checklist-groups/general/supplier'),
            token: $token,
        )->json();
    }

    private function getChecklists(string $token)
    {
        return $this->getGroups($token)[0]['context']['checklists'];
    }

    public function test_supplier_template_checklist_group_insert()
    {
        $token = $this->login();
        $data = $this->getGroups($token->json());

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

    public function test_supplier_template_checklist_insert()
    {
        $token = $this->login();
        $data = $this->getGroups($token->json());
        $groupId = $data[0]['id'];

        $checklists = $this->getChecklists($token->json());
        $lastCount = count($checklists);

        $response = $this->postJsonAuthorised(
            uri: self::generateUri("/templates/checklist-groups/$groupId/checklists"),
            token: $token->json(),
            data: [
                'description' => 'Lorem ipsum dolor sit amet',
            ]
        );

        $response->assertStatus(200);

        $data = $this->getChecklists($token->json());
        $this->assertCount($lastCount + 1, $data);
        $this->cleanAutoBeforeAssertingJsonSnapshot($this->getGroups($token->json()));
    }

    public function test_supplier_template_checklist_update()
    {
        $token = $this->login();
        $data = $this->getGroups($token->json());
        $groupId = $data[0]['id'];

        $checklists = $this->getChecklists($token->json());
        $id = $checklists[0]['id'];
        $lastCount = count($checklists);

        $response = $this->putJsonAuthorised(
            uri: self::generateUri("/templates/checklist-groups/$groupId/checklists/$id"),
            token: $token->json(),
            data: [
                'description' => 'Consectetur adipiscing elit sed do.',
                'sortOrder' => 5,
            ]
        );
        $response->assertStatus(200);

        $data = $this->getChecklists($token->json());
        $this->assertCount($lastCount, $data);
        $this->cleanAutoBeforeAssertingJsonSnapshot($this->getGroups($token->json()));
    }

    public function test_supplier_template_checklist_delete()
    {
        $token = $this->login();
        $data = $this->getGroups($token->json());
        $groupId = $data[0]['id'];

        $checklists = $this->getChecklists($token->json(), $groupId);
        $id = $checklists[0]['id'];
        $lastCount = count($checklists);

        $response = $this->deleteJsonAuthorised(
            uri: self::generateUri("/templates/checklist-groups/$groupId/checklists/$id"),
            token: $token->json(),
        );
        $response->assertStatus(200);

        $data = $this->getChecklists($token->json());
        $this->assertCount($lastCount - 1, $data);
        $this->cleanAutoBeforeAssertingJsonSnapshot($this->getGroups($token->json()));
    }

    public function test_supplier_template_checklist_group_update()
    {
        $token = $this->login();
        $data = $this->getGroups($token->json());
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

        $data = $this->getGroups($token->json());
        $this->assertCount($lastCount, $data);
        $this->cleanAutoBeforeAssertingJsonSnapshot($data);
    }

    public function test_supplier_template_checklist_group_delete()
    {
        $token = $this->login();
        $data = $this->getGroups($token->json());
        $lastCount = count($data);
        $id = $data[0]['id'];

        $response = $this->deleteJsonAuthorised(
            uri: self::generateUri("/templates/checklist-groups/$id"),
            token: $token->json(),
        );
        $response->assertStatus(200);

        $data = $this->getGroups($token->json());
        $this->assertCount($lastCount - 1, $data);
        $this->cleanAutoBeforeAssertingJsonSnapshot($data);
    }
}
