<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Dto\Requests\Client\UpdateProfileRequestDto;
use App\Dto\Response\ClientDto;
use App\Models\Client\Context\ClientContextType;
use App\Services\Client\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController
{
    public function index(
        ProfileService $service
    ): JsonResponse {
        return transaction(function () use ($service) {
            $result = $service->get();

            return ClientDto::buildFromContextPair(
                $result, [
                    ClientContextType::CONTACT_NUMBER,
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
