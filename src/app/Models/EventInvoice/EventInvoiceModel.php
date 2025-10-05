<?php

declare(strict_types=1);

namespace App\Models\EventInvoice;

use App\Data\Dto\Response\EventInvoiceDto;
use App\Enums\EventInvoiceStatus;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventInvoiceModel
{
    public function __construct(
        public UuidInterface $id,
        public string $invoiceNumber,
        public string $name,
        public string $email,
        public ?UuidInterface $contactNumberId,
        public ?UuidInterface $addressId,
        public EventInvoiceStatus $status,
        public UuidInterface $eventId,
        public UuidInterface $clientId,
        public UuidInterface $supplierId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): EventInvoiceDto
    {
        return new EventInvoiceDto(
            id: $this->id,
            invoiceNumber: $this->invoiceNumber,
            name: $this->name,
            email: $this->email,
            contactNumberId: $this->contactNumberId,
            addressId: $this->addressId,
            status: $this->status,
            clientId: $this->clientId,
            supplierId: $this->supplierId,
            eventId: $this->eventId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
