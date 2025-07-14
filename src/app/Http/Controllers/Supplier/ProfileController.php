<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supplier;

use App\Dto\Requests\Staff\UpdateProfileRequestDto;
use App\Services\Staff\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController
{
    public function index(
        ProfileService $service
    ): JsonResponse {
        return transaction(function () use ($service) {
            $result = $service->get();

            return $result->toDto();
        });
    }

    public function update(
        Request $request,
        ProfileService $service,
    ): JsonResponse {
        return transaction(function () use ($service, $request) {
            $dto = UpdateProfileRequestDto::fromRequest($request);
            $service->update($dto);
        });
    }
}
