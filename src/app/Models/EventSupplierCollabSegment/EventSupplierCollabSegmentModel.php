<?php

declare(strict_types=1);

namespace App\Models\EventSupplierCollabSegment;

use App\Data\Dto\Response\EventSupplierCollabSegmentDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSupplierCollabSegmentModel
{
    public function __construct(
        public UuidInterface $id,
        public UuidInterface $eventSupplierCollabId,
        public UuidInterface $eventSegmentId,
        public UuidInterface $supplierId,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}

    public function toDto(): EventSupplierCollabSegmentDto
    {
        return new EventSupplierCollabSegmentDto(
            id: $this->id,
            eventSupplierCollabId: $this->eventSupplierCollabId,
            eventSegmentId: $this->eventSegmentId,
            supplierId: $this->supplierId,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
