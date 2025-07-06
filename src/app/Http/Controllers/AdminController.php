<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\Requests\AdminStoreRequestDto;
use App\Dto\Requests\AdminUpdateRequestDto;
use App\Models\Admin\AdminEntity;
use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AdminController
{

    /**
     * @param AdminService $service
     * @return JsonResponse
     */
    public function index(AdminService $service): JsonResponse
    {
        $result = $service->search();
        $dto = $result->map(function(AdminEntity $entity) {
            return $entity->toDto();
        });

        return response()->json($dto);
    }

    /**
     * @param AdminService $service
     * @param string $id
     * @return JsonResponse
     */
    public function show(
        AdminService $service,
        string $id
    ): JsonResponse
    {
        $entity = $service->getById(
            Uuid::fromString($id)
        );

        return response()->json(
            $entity->toDto()
        );
    }

    /**
     * @param AdminService $service
     * @param Request $request
     * @return JsonResponse
     */
    public function store(
        AdminService $service,
        Request $request
    ): JsonResponse
    {
        $requestDto = AdminStoreRequestDto::fromRequest($request);
        $entity = $service->store($requestDto);

        return response()->json($entity->toDto());
    }

    /**
     * @param AdminService $service
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(
        AdminService $service,
        Request $request,
        string $id
    ): JsonResponse
    {
        $requestDto = AdminUpdateRequestDto::fromRequest($request);
        $entity = $service->update(
            $requestDto,
            Uuid::fromString($id)
        );

        return response()->json($entity->toDto());
    }

    /**
     * @param AdminService $service
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(
        AdminService $service,
        string $id
    ): JsonResponse
    {
        $service->destroy(
            Uuid::fromString($id)
        );

        return response()->json();
    }

}