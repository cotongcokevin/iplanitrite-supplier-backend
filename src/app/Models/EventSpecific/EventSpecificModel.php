<?php

declare(strict_types=1);

namespace App\Models\EventSpecific;

use App\Data\Dto\Response\EventSpecificDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSpecificModel
{
    public function __construct(
        public UuidInterface $id,
        public UuidInterface $eventId,
        public [convertMeToDto] $udf,
        public UuidInterface $supplierId,
        public UuidInterface $createdBy,
        public UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}

    public function toDto(): EventSpecificDto
    {
        return new EventSpecificDto(
            id: $this->id,
            eventId: $this->eventId,
            udf: $this->udf,
            supplierId: $this->supplierId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
