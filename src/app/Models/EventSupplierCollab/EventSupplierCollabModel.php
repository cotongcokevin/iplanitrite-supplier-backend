<?php

declare(strict_types=1);

namespace App\Models\EventSupplierCollab;

use App\Data\Dto\Response\EventSupplierCollabDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSupplierCollabModel
{
    public function __construct(
        public UuidInterface $id,
        public string $status,
        public UuidInterface $supplierId,
        public UuidInterface $supplierPartnerId,
        public UuidInterface $eventId,
        public UuidInterface $createdBy,
        public UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}

    public function toDto(): EventSupplierCollabDto
    {
        return new EventSupplierCollabDto(
            id: $this->id,
            status: $this->status,
            supplierId: $this->supplierId,
            supplierPartnerId: $this->supplierPartnerId,
            eventId: $this->eventId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
