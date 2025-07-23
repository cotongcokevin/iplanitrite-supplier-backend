<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSupplierCollabDto extends ResponseDto
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
}
