<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Dto\Requests\Supplier\SupplierStoreRequestDto;
use App\Dto\Requests\Supplier\SupplierUpdateRequestDto;
use App\Models\Supplier\SupplierModel;
use App\Services\Supplier\SupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AdminSupplierController
{
    public function index(SupplierService $service): JsonResponse
    {
        return transaction(function () use ($service) {
            $result = $service->search();

            return $result->map(function (SupplierModel $entity) {
                return $entity->toDto();
            });
        });
    }

    public function show(
        SupplierService $service,
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
        SupplierService $service,
        Request $request
    ): JsonResponse {
        return transaction(function () use ($service, $request) {
            $requestDto = SupplierStoreRequestDto::fromRequest($request);
            $entity = $service->store($requestDto);

            return $entity->toDto();
        });
    }

    public function update(
        SupplierService $service,
        Request $request,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $request, $id) {
            $requestDto = SupplierUpdateRequestDto::fromRequest($request);
            $entity = $service->update(
                $requestDto,
                Uuid::fromString($id)
            );

            return $entity->toDto();
        });
    }

    public function destroy(
        SupplierService $service,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $id) {
            $service->destroy(
                Uuid::fromString($id)
            );
        });
    }
}
