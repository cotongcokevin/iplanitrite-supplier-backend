<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\Requests\AdminStoreRequestDto;
use App\Dto\Requests\AdminUpdateRequestDto;
use App\Models\Admin\AdminModelData;
use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AdminController
{
    public function index(AdminService $service): JsonResponse
    {
        return transaction(function () use ($service) {
            $result = $service->search();

            return $result->map(function (AdminModelData $entity) {
                return $entity->toDto();
            });
        });
    }

    public function show(
        AdminService $service,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $id) {
            $entity = $service->getById(
                Uuid::fromString($id)
            );

            return $entity->toDto();
        });
    }

    public function store(
        AdminService $service,
        Request $request
    ): JsonResponse {
        return transaction(function () use ($service, $request) {
            $requestDto = AdminStoreRequestDto::fromRequest($request);
            $entity = $service->store($requestDto);

            return $entity->toDto();
        });
    }

    public function update(
        AdminService $service,
        Request $request,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $request, $id) {
            $requestDto = AdminUpdateRequestDto::fromRequest($request);
            $entity = $service->update(
                $requestDto,
                Uuid::fromString($id)
            );

            return $entity->toDto();
        });
    }

    public function destroy(
        AdminService $service,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $id) {
            $service->destroy(
                Uuid::fromString($id)
            );
        });
    }
}
