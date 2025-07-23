<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Ramsey\Uuid\UuidInterface;
use Carbon\Carbon;

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
