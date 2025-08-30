<?php

declare(strict_types=1);

namespace App\Models\SupplierTemplateTimeline;

use App\Data\Dto\Response\SupplierTemplateTimelineDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierTemplateTimelineModel
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public bool $isRsvp,
        public bool $isMainEvent,
        public string $eventType,
        public UuidInterface $supplierId,
        public UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}

    public function toDto(): SupplierTemplateTimelineDto
    {
        return new SupplierTemplateTimelineDto(
            id: $this->id,
            name: $this->name,
            isRsvp: $this->isRsvp,
            isMainEvent: $this->isMainEvent,
            eventType: $this->eventType,
            supplierId: $this->supplierId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
