<?php

namespace App\Repositories\EventInvoiceRepository\Data;

use App\Enums\EventInvoiceStatus;
use Ramsey\Uuid\UuidInterface;

class EventInvoiceCreateRepoData
{
    public function __construct(
        public string $invoiceNumber,
        public string $name,
        public string $email,
        public UuidInterface $eventId,
        public UuidInterface $contactNumberId,
        public UuidInterface $addressId,
        public EventInvoiceStatus $status,
        public UuidInterface $clientId,
    ) {}
}