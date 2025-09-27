<?php

namespace App\Http\Controllers;

use App\Data\Dto\Requests\EventCreateRequestDto;
use App\Enums\EventStatus;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Ramsey\Uuid\Uuid;

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

    public function updateStatus(
        EventService $service,
        Request $request,
        string $eventId
    ) {
        return transaction(function () use ($service, $request, $eventId) {
            $request->validate([
                'status' => ['required', new Enum(EventStatus::class)]]
            );

            $service->updateStatus(
                EventStatus::from($request->status),
                Uuid::fromString($eventId)
            );
        });
    }
}
