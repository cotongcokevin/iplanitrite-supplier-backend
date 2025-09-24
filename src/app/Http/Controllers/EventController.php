<?php

namespace App\Http\Controllers;

use App\Data\Dto\Requests\EventCreateRequestDto;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController
{
    public function store(
        EventService $service,
        Request $request
    ): JsonResponse {
        return transaction(function () use ($service, $request) {
            $requestDto = EventCreateRequestDto::fromRequest($request);
            $service->create($requestDto);
        });
    }
}
