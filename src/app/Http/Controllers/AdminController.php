<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\Requests\AdminStoreRequestDto;
use App\Dto\Requests\AdminUpdateRequestDto;
use App\Models\Admin\AdminModelData;
use App\Services\AdminService;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Throwable;

class AdminController
{
    /**
     * @throws Throwable
     */
    public function index(AdminService $service): JsonResponse
    {
        return transaction(function() use ($service) {
            $result = $service->search();

            return $result->map(function (AdminModelData $entity) {
                return $entity->toDto();
            });
        });
    }

    /**
     * @throws Throwable
     */
    public function show(
        AdminService $service,
        string $id
    ): JsonResponse {
        return transaction(function() use ($service, $id) {
            $entity = $service->getById(
                Uuid::fromString($id)
            );

            return $entity->toDto();
        });
    }

    /**
     * @throws Throwable
     */
    public function store(
        AdminService $service,
        Request $request
    ): JsonResponse {
        return transaction(function() use ($service, $request) {
            $requestDto = AdminStoreRequestDto::fromRequest($request);
            $entity = $service->store($requestDto);

            return $entity->toDto();
        });
    }

    /**
     * @throws Throwable
     */
    public function update(
        AdminService $service,
        Request $request,
        string $id
    ): JsonResponse {
        return transaction(function() use ($service, $request, $id) {
            $requestDto = AdminUpdateRequestDto::fromRequest($request);
            $entity = $service->update(
                $requestDto,
                Uuid::fromString($id)
            );

            return $entity->toDto();
        });
    }

    /**
     * @throws Throwable
     */
    public function destroy(
        AdminService $service,
        string $id
    ): JsonResponse {
        return transaction(function() use ($service, $id) {
            $service->destroy(
                Uuid::fromString($id)
            );
        });
    }
}