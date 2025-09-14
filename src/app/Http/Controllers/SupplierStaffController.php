<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Pair;
use App\Data\Dto\Requests\SupplierStaffCreateRequestDto;
use App\Models\SupplierStaff\Context\SupplierStaffContextType;
use App\Models\SupplierStaff\SupplierStaffModel;
use App\Services\SupplierStaffService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SupplierStaffController
{
    public function index(SupplierStaffService $service): JsonResponse
    {
        $contexts = [SupplierStaffContextType::CONTACT_NUMBER, SupplierStaffContextType::ADDRESS];

        return transaction(function () use ($service, $contexts) {
            return $service->searchWithContext($contexts)->map(function (Pair $result) use ($contexts) {
                /** @var SupplierStaffModel $model */
                $model = $result->first;

                return $model->toDto($result->second, $contexts);
            });
        });

    }

    public function show(SupplierStaffService $service, string $id): JsonResponse
    {

        return transaction(function () use ($service, $id) {
            $contexts = [SupplierStaffContextType::CONTACT_NUMBER, SupplierStaffContextType::ADDRESS];
            $result = $service->getByIdWithContext(
                Uuid::fromString($id),
                $contexts
            );

            $model = $result->first;

            return $model->toDto($result->second, $contexts);
        });

    }

    public function store(SupplierStaffService $service, Request $request): JsonResponse
    {
        return transaction(function () use ($service, $request) {
            $requestDto = SupplierStaffCreateRequestDto::fromRequest($request);
            $service->create($requestDto);
        });
    }

    public function update(
        SupplierStaffService $service,
        Request $request,
        string $id
    ): JsonResponse {
        return transaction(function () use ($service, $request, $id) {
            $requestDto = SupplierStaffCreateRequestDto::fromRequest($request);
            $service->update(
                $requestDto,
                Uuid::fromString($id)
            );
        });
    }
    //
    //    public function destroy(
    //        SupplierStaffService $service,
    //        string $id
    //    ): JsonResponse {
    //        return transaction(function () use ($service, $id) {
    //            $service->destroy(Uuid::fromString($id));
    //        });
    //    }

}
