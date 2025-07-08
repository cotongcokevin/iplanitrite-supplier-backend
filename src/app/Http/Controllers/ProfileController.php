<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Accountable;
use App\Dto\Requests\AdminUpdateRequestDto;
use App\Models\Admin\AdminModelData;
use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ProfileController
{
    public function index(
        AdminService $service,
        Accountable $accountable
    ): JsonResponse {
        return transaction(function() use ($accountable, $service) {
            $admin = $accountable->get();
            $id = Uuid::fromString($admin->id);

            $result = $service->getById($id);

            return $result->toDto();
        });
    }

    public function update(
        Request $request,
        AdminService $service,
        Accountable $accountable
    ): JsonResponse {
        return transaction(function() use ($accountable, $service, $request) {
            $admin = $accountable->get();
            $id = Uuid::fromString($admin->id);

            $dto = AdminUpdateRequestDto::fromRequest($request);
            $result = $service->update(
                $dto,
                $id
            );

            return $result->toDto();
        });
    }
}
