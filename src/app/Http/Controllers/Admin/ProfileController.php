<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Principals\Principal;
use App\Data\Dto\Requests\Admin\AdminUpdateRequestDto;
use App\Services\Admin\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController
{
    public function index(
        AdminService $service,
        Principal $principal
    ): JsonResponse {
        return transaction(function () use ($principal, $service) {
            $admin = $principal->get();
            $result = $service->getById($admin->id);

            return $result->toDto();
        });
    }

    public function update(
        Request $request,
        AdminService $service,
        Principal $principal
    ): JsonResponse {
        return transaction(function () use ($principal, $service, $request) {
            $admin = $principal->get();

            $dto = AdminUpdateRequestDto::fromRequest($request);
            $result = $service->update(
                $dto,
                $admin->id
            );

            return $result->toDto();
        });
    }
}
