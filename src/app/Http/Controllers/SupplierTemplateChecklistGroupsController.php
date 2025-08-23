<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Pair;
use App\Data\Dto\Requests\SupplierTemplateChecklistGroupCreateRequestDto;
use App\Data\Dto\Requests\SupplierTemplateChecklistGroupUpdateRequestDto;
use App\Enums\SupplierTemplateChecklistGroupAccountableTo;
use App\Enums\SupplierTemplateChecklistGroupSection;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContextType;
use App\Models\SupplierTemplateChecklistGroup\SupplierTemplateChecklistGroupModel;
use App\Services\SupplierTemplateChecklistGroupService;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SupplierTemplateChecklistGroupsController
{
    public function index(
        SupplierTemplateChecklistGroupService $service,
        string $section,
        string $accountableTo
    ) {
        $contexts = [
            SupplierTemplateChecklistGroupContextType::CHECKLISTS,
        ];

        return transaction(function () use ($service, $section, $accountableTo, $contexts) {
            return $service->getWithContext(
                SupplierTemplateChecklistGroupSection::from(strtoupper($section)),
                SupplierTemplateChecklistGroupAccountableTo::from(strtoupper($accountableTo)),
                $contexts
            )->map(function (Pair $result) use ($contexts) {
                /** @var SupplierTemplateChecklistGroupModel $model */
                $model = $result->first;

                return $model->toDto($result->second, $contexts);
            });
        });
    }

    public function store(
        SupplierTemplateChecklistGroupService $service,
        Request $request
    ) {
        return transaction(function () use ($service, $request) {
            $requestDto = SupplierTemplateChecklistGroupCreateRequestDto::fromRequest($request);
            $service->create($requestDto);
        });
    }

    public function update(
        SupplierTemplateChecklistGroupService $service,
        Request $request,
        string $id
    ) {
        return transaction(function () use ($service, $request, $id) {
            $requestDto = SupplierTemplateChecklistGroupUpdateRequestDto::fromRequest($request);
            $service->update(
                $requestDto,
                Uuid::fromString($id)
            );
        });
    }

    public function destroy(
        SupplierTemplateChecklistGroupService $service,
        string $id
    ) {
        return transaction(function () use ($service, $id) {
            $service->destroy(
                Uuid::fromString($id)
            );
        });
    }
}
