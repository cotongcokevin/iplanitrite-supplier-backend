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
        $result = $service->search();
        $dto = $result->map(function (AdminModelData $entity) {
            return $entity->toDto();
        });

        return response()->json($dto);
    }

    public function show(
        AdminService $service,
        string $id
    ): JsonResponse {
        $entity = $service->getById(
            Uuid::fromString($id)
        );

        return response()->json(
            $entity->toDto()
        );
    }

    public function store(
        AdminService $service,
        Request $request
    ): JsonResponse {
        $requestDto = AdminStoreRequestDto::fromRequest($request);
        $entity = $service->store($requestDto);

        return response()->json($entity->toDto());
    }

    public function update(
        AdminService $service,
        Request $request,
        string $id
    ): JsonResponse {
        $requestDto = AdminUpdateRequestDto::fromRequest($request);
        $entity = $service->update(
            $requestDto,
            Uuid::fromString($id)
        );

        return response()->json($entity->toDto());
    }

    public function destroy(
        AdminService $service,
        string $id
    ): JsonResponse {
        $service->destroy(
            Uuid::fromString($id)
        );

        return response()->json();
    }
}
