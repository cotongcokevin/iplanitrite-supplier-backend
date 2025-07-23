<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supplier;

use App\Data\Dto\Requests\LoginRequestDto;
use App\Services\Supplier\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController
{
    public function index(
        EventService $service,
        Request $request
    ): JsonResponse {
        return transaction(
            function () {}
        );
    }

    public function store(
        EventService $service,
        Request $request
    ): JsonResponse {
        return transaction(
            function () use ($service, $request) {
                $requestDto = LoginRequestDto::fromRequest($request);

                return $service->create($requestDto);
            }
        );
    }
}
