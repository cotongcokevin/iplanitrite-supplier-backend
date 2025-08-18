<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\Dto\Requests\Admin\AdminStoreRequestDto;
use App\Data\Dto\Requests\Admin\AdminUpdateRequestDto;
use App\Models\Admin\AdminModel;
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

            return $result->map(function (AdminModel $model) {
                return $model->toDto();
            });
        });
    }

    public function show(
        AdminService $service,
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
        AdminService $service,
        Request $request
    ): JsonResponse {
        return transaction(function () use ($service, $request) {
            $requestDto = AdminStoreRequestDto::fromRequest($request);
            $model = $service->store($requestDto);

            return $model->toDto();
        });
    }

    public function update(
        AdminService $service,
        Request $request,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $request, $id) {
            $requestDto = AdminUpdateRequestDto::fromRequest($request);
            $model = $service->update(
                $requestDto,
                Uuid::fromString($id)
            );

            return $model->toDto();
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
