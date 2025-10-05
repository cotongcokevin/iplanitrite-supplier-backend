<?php

declare(strict_types=1);

namespace App\Models\EventInvoiceItem;

use App\Data\Dto\Response\EventInvoiceItemDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventInvoiceItemModel
{
    public function __construct(
        public UuidInterface $id,
        public UuidInterface $eventCostId,
        public UuidInterface $eventInvoiceId,
        public UuidInterface $supplierId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): EventInvoiceItemDto
    {
        return new EventInvoiceItemDto(
            id: $this->id,
            eventCostId: $this->eventCostId,
            eventInvoiceId: $this->eventInvoiceId,
            supplierId: $this->supplierId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
