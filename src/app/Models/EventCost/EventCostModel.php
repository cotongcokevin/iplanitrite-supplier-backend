<?php

declare(strict_types=1);

namespace App\Models\EventCost;

use App\Data\Dto\Response\EventCostDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventCostModel
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public float $amount,
        public UuidInterface $eventId,
        public UuidInterface $supplierId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): EventCostDto
    {
        return new EventCostDto(
            id: $this->id,
            name: $this->name,
            amount: $this->amount,
            eventId: $this->eventId,
            supplierId: $this->supplierId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
