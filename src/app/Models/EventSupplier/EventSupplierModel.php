<?php

declare(strict_types=1);

namespace App\Models\EventSupplier;

use App\Data\Dto\Response\EventSupplierDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSupplierModel
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public string $status,
        public ?string $reasonForCancellation,
        public UuidInterface $supplierId,
        public UuidInterface $eventId,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}

    public function toDto(): EventSupplierDto
    {
        return new EventSupplierDto(
            id: $this->id,
            name: $this->name,
            status: $this->status,
            reasonForCancellation: $this->reasonForCancellation,
            supplierId: $this->supplierId,
            eventId: $this->eventId,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
