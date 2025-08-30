<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\Dto\Requests\SupplierTemplateChecklistCreateRequestDto;
use App\Data\Dto\Requests\SupplierTemplateChecklistSortRequestDto;
use App\Data\Dto\Requests\SupplierTemplateChecklistUpdateRequestDto;
use App\Services\SupplierTemplateChecklistService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SupplierTemplateChecklistController
{
    public function store(
        SupplierTemplateChecklistService $service,
        Request $request,
        string $groupId
    ): JsonResponse {
        return transaction(function () use ($service, $groupId, $request) {
            $requestDto = SupplierTemplateChecklistCreateRequestDto::fromRequest($request);
            $service->create(
                $requestDto,
                Uuid::fromString($groupId)
            );
        });
    }

    public function update(
        SupplierTemplateChecklistService $service,
        Request $request,
        string $groupId,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $request, $groupId, $id) {
            $requestDto = SupplierTemplateChecklistUpdateRequestDto::fromRequest($request);
            $service->update(
                $requestDto,
                Uuid::fromString($groupId),
                Uuid::fromString($id)
            );
        });
    }

    public function sort(
        SupplierTemplateChecklistService $service,
        string $groupId,
        Request $request,
    ): JsonResponse {
        return transaction(function () use ($service, $request, $groupId) {
            $requestDto = SupplierTemplateChecklistSortRequestDto::fromRequest($request);
            $service->sort(
                $requestDto,
                Uuid::fromString($groupId),
            );
        });
    }

    public function destroy(
        SupplierTemplateChecklistService $service,
        string $groupId,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $groupId, $id) {
            $service->delete(
                Uuid::fromString($groupId),
                Uuid::fromString($id)
            );
        });
    }
}
