<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Dto\Requests\Admin\SupplierStoreRequestDto;
use App\Data\Dto\Requests\Admin\SupplierUpdateRequestDto;
use App\Models\Supplier\SupplierModel;
use App\Services\Admin\SupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AdminSupplierController
{
    public function index(SupplierService $service): JsonResponse
    {
        return transaction(function () use ($service) {
            $result = $service->search();

            return $result->map(function (SupplierModel $model) {
                return $model->toDto();
            });
        });
    }

    public function show(
        SupplierService $service,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $id) {
            $model = $service->getById(
                Uuid::fromString($id)
            );

            return $model->toDto();
        });
    }

    public function store(
        SupplierService $service,
        Request $request
    ): JsonResponse {
        return transaction(function () use ($service, $request) {
            $requestDto = SupplierStoreRequestDto::fromRequest($request);
            $model = $service->store($requestDto);

            return $model->toDto();
        });
    }

    public function update(
        SupplierService $service,
        Request $request,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $request, $id) {
            $requestDto = SupplierUpdateRequestDto::fromRequest($request);
            $model = $service->update(
                $requestDto,
                Uuid::fromString($id)
            );

            return $model->toDto();
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
