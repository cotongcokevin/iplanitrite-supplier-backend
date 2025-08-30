<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\Dto\Requests\SupplierTemplateTimelineCreateRequestDto;
use App\Data\Dto\Requests\SupplierTemplateTimelineUpdateRequestDto;
use App\Enums\EventType;
use App\Models\SupplierTemplateTimeline\SupplierTemplateTimelineModel;
use App\Services\SupplierTemplateTimelineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SupplierTemplateTimelineController
{

    public function index(
        SupplierTemplateTimelineService $service,
        string $eventType
    ): JsonResponse {
        return transaction(function() use ($service, $eventType) {
            return $service->getByEventType(
                EventType::from($eventType)
            )->map(function(SupplierTemplateTimelineModel $timeline) {
                return $timeline->toDto();
            });
        });
    }

    public function store(
        SupplierTemplateTimelineService $service,
        Request $request
    ): JsonResponse {
        $dto = SupplierTemplateTimelineCreateRequestDto::fromRequest($request);

        return transaction(function() use ($service, $dto) {
            $service->create($dto);
        });
    }

    public function update(
        SupplierTemplateTimelineService $service,
        Request $request,
        string $id
    ): JsonResponse {
        $dto = SupplierTemplateTimelineUpdateRequestDto::fromRequest($request);

        return transaction(function() use ($service, $dto, $id) {
            $service->update(
                $dto,
                Uuid::fromString($id)
            );
        });
    }

    public function destroy(
        SupplierTemplateTimelineService $service,
        string $id
    ): JsonResponse {
        return transaction(function() use ($service, $id) {
            $service->destroy(Uuid::fromString($id));
        });
    }

}