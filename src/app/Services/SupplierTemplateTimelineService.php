<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Dto\Requests\SupplierTemplateTimelineCreateRequestDto;
use App\Data\Dto\Requests\SupplierTemplateTimelineUpdateRequestDto;
use App\Enums\EventType;
use App\Models\SupplierTemplateTimeline\SupplierTemplateTimelineModel;
use App\Repositories\SupplierTemplateTimelineRepository\SupplierTemplateTimelineRepository;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

class SupplierTemplateTimelineService
{

    public function __construct(
        private SupplierTemplateTimelineRepository $repository
    ) { }

    /**
     * @param EventType $eventType
     * @return Collection<SupplierTemplateTimelineModel>
     */
    public function getByEventType(EventType $eventType): Collection {
        return $this->repository->getByEventType($eventType);
    }

    public function create(SupplierTemplateTimelineCreateRequestDto $dto): void {
        $this->repository->create(
            name: $dto->name,
            isRsvp: $dto->isRsvp,
            eventType: $dto->eventType
        );
    }

    public function update(SupplierTemplateTimelineUpdateRequestDto $dto, UuidInterface $id): void {
        $this->repository->update(
            id: $id,
            name: $dto->name,
            isRsvp: $dto->isRsvp,
        );
    }

    public function destroy(UuidInterface $id): void {
        $this->repository->destroy($id);
    }

}