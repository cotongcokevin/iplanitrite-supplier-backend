<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supplier;

use App\Dto\Requests\Staff\UpdateProfileRequestDto;
use App\Dto\Response\SupplierStaffDto;
use App\Models\SupplierStaff\Context\SupplierStaffContextType;
use App\Services\Supplier\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController
{
    public function index(
        ProfileService $service
    ): JsonResponse {
        return transaction(function () use ($service) {
            $result = $service->get();

            return SupplierStaffDto::buildFromContextPair(
                $result, [
                    SupplierStaffContextType::ADDRESS,
                    SupplierStaffContextType::CONTACT_NUMBER,
                ]
            );
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
