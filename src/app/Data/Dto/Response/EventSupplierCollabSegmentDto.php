<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSupplierCollabSegmentDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public UuidInterface $eventSupplierCollabId,
        public UuidInterface $eventSegmentId,
        public UuidInterface $supplierId,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}
}
