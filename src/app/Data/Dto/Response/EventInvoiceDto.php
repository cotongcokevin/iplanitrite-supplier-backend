<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use App\Enums\EventInvoiceStatus;
use Ramsey\Uuid\UuidInterface;
use Carbon\Carbon;

class EventInvoiceDto extends ResponseDto
{
    
    public function __construct(
        public UuidInterface $id,
        public string $invoiceNumber,
        public string $name,
        public string $email,
        public ?UuidInterface $contactNumberId,
        public ?UuidInterface $addressId,
        public EventInvoiceStatus $status,
        public UuidInterface $clientId,
        public UuidInterface $supplierId,
        public UuidInterface $eventId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
